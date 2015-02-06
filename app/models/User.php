<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;

class User extends EloquentMongo implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    const ROLE_USER     =   'user';

    const ROLE_ADMIN    =   'admin';
    const REMIND_PASSWORD_SALT   =  'BoREjFPUSsgsHbeJ';

    const VERIFY_ACCOUNT_SALT    =  '4vf9zMJozK4VYS8k';

    protected $userSurveys  =   null;

	protected $collection   =   'users';

    protected $primaryKey   =  'userid';

    protected $fillable = [
        'userid',
        'firstname',
        'lastname',
        'password',
        'gender',
        'dob',
        'bio',
        'avatar',
        'email',
        'social',
        'address',
        'activated',
        'role',
        'capability'
    ];

    protected $guarded = [
        '_id',
        'userid',
        'location',
        'surveys'   // The array of surveys, user has answered
    ];

    /**
     * Save address of the user
     * 1. Method's looking for the coordinates of the address
     * 2. Method makes encryption of it
     *
     * @param $address
     *
     * @return \User
     **/
    public function setAddressAttribute($address)
    {
        $point = $this->_convertAddressToPoint($address);

        if ($point != null) {
            $location = $point->jsonSerialize();
            $location['coordinates'] = array_values($location['coordinates']);

            $this->_setEncryptedAttribute('location', $location);
        }

        $this->_setEncryptedAttribute('address', $address);
    }

    /**
     * Assigns new account to the user
     *
     * @param $account
     *
     * @return \User
     **/
    public function assignAccount(\Social\ServiceAbstract $account)
    {
        $accountData = $account->getAccountData();

        $social = $this->getAttribute('social');

        $social[$account->getServiceName()] = $accountData;

        $this->setAttribute('social', $social);

        $this->save();

        return $this;
    }

    /**
     * Returns point of address string
     *
     * @param $address
     *
     * @return \GeoJson\Geometry\Point
     **/
    private function _convertAddressToPoint($address)
    {
        $geoCoder = new GoogleMapsGeocoder();
        $geoCoder->setAddress($address);

        $response = $geoCoder->geocode();

        if ($response['status'] != 'OK' || empty($response['results'])) {
            return null;
        }

        $result = array_shift($response['results']);

        if (!isset($result['geometry']['location'])) {
            return null;
        }

        $point = new \GeoJson\Geometry\Point($result['geometry']['location']);

        return $point;
    }

    /**
     * Returns surrogate model of the user
     *
     * @param $unlock
     *
     * @return Jenssegers\Mongodb\Relations\HasOne
     **/
    public function surrogate($unlock)
    {
        if (!in_array($unlock, array(
            \Surrogate::PASSWORD, \Surrogate::SECURITY_QUESTION)
        )) {
            throw new InvalidArgumentException("Unlock type is invalid");
        }

        $relation = $this->hasOne(\Surrogate::class, 'userid', 'userid');
        $relation->getQuery()->getQuery()->where('unlock', $unlock);

        return $relation;
    }

    /**
     * Sets encrypted `dob` attribute
     *
     * @param $value
     *
     * @return mixed
     **/
    public function setDobAttribute($value)
    {
        $this->_setEncryptedAttribute('dob', $value);
    }

    /**
     * Returns decrypted `dob` attribute
     *
     * @return mixed
     **/
    public function getDobAttribute()
    {
        if (isset($this->attributes['dob']) && !empty($this->attributes['dob'])) {

            $value = '';
            $this->_getEncryptedAttribute('dob', $value);

            return \Carbon\Carbon::parse($value);
        }

        return null;
    }

    /**
     * Sets encrypted `gender` attribute
     *
     * @param $value
     *
     * @return mixed
     **/
    public function setGenderAttribute($value)
    {
        $this->_setEncryptedAttribute('gender', $value);
    }

    /**
     * Returns decrypted `gender` attribute
     *
     * @return mixed
     **/
    public function getGenderAttribute()
    {
        if (isset($this->attributes['gender'])) {

            $value = '';
            $this->_getEncryptedAttribute('gender', $value);

            return $value;
        }

        return null;
    }


    /**
     * Returns decrypted `location` attribute
     *
     * @return mixed
     **/
    public function getLocationAttribute()
    {
        if (isset($this->attributes['location'])) {

            $value = '';
            $this->_getEncryptedAttribute('location', $value);

            return $value;
        }

        return null;
    }


    /**
     * Returns decrypted `address` attribute
     *
     * @return string
     **/
    public function getAddressAttribute()
    {
        if (isset($this->attributes['address'])) {

            $value = '';
            $this->_getEncryptedAttribute('address', $value);

            return $value;
        }

        return null;
    }

    /**
     * Sets encrypted `surveys` attribute
     *
     * @param $value
     **/
    public function setSurveysAttribute($value)
    {
        $this->_setEncryptedAttribute('surveys', $value);
    }

    /**
     * Returns decrypted `surveys` attribute
     *
     * @return string
     **/
    public function getSurveysAttribute()
    {
        if (isset($this->attributes['surveys'])) {

            $value = '';
            $this->_getEncryptedAttribute('surveys', $value);

            return $value;
        }

        return null;
    }

    /**
     * Returns into the value (by link) decrypted value
     * of the attribute
     *
     * @param $attribute
     * @param &$value
     *
     * @return string
     **/
    private function _getEncryptedAttribute($attribute, &$value)
    {
        Crypt::setKey(Session::get(\Surrogate::class . '-' . \Surrogate::PASSWORD));

        $value = $this->attributes[$attribute];

        $value = Crypt::decrypt($this->attributes[$attribute]);

        Crypt::setKey(Config::get('app.key'));
    }

    /**
     * Makes encryption of the value of the attribute
     *
     * @param $attribute
     * @param $value
     *
     * @return null
     **/
    private function _setEncryptedAttribute($attribute, $value)
    {
        Crypt::setKey(Session::get(\Surrogate::class . '-' . \Surrogate::PASSWORD));

        $this->attributes[$attribute] = Crypt::encrypt($value);

        Crypt::setKey(Config::get('app.key'));
    }

    /**
     * Generates new link to reset the password
     * and sends it to the user
     *
     * @return void
     **/
    public function passwordRemind()
    {
        $remindPasswordKey  = $this->userid;
        $remindPasswordKey .= '|' . Hash::make(
                $this->password . self::REMIND_PASSWORD_SALT
        );
        $remindPasswordKey .= '|' . \Carbon\Carbon::now()->addHours(24);

        $remindPasswordToken = Crypt::encrypt($remindPasswordKey);

        $userEmail = $this->email;

        Mail::send(
            'emails.auth.reminder',
            array('token' => $remindPasswordToken),

            function($message) use ($userEmail) {
                $message->subject('Password reset');
                $message->to($userEmail);
            });
    }

    /**
     * Check if user's role is admin
     *
     * @return boolean
     **/
    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }

    /**
     * Check if user's role is an user
     *
     * @return boolean
     **/
    public function isUser()
    {
        return $this->role == self::ROLE_USER;
    }


    /**
     * Returns object to manage user's surveys
     *
     * @return UserSurveys
     */
    public function surveys()
    {
        if ($this->userSurveys == null) {
            $this->userSurveys = new UserSurveys($this);
        }

        return $this->userSurveys;
    }

    /**
     * Model events observe
     *
     * @return void
     **/
    public static function boot()
    {
        parent::boot();

        static::creating(function($user) {

            $user->userid = uniqid();

            if (!$user->role) {

                $user->role = self::ROLE_USER;
            }

            if ($user->role == self::ROLE_USER) {

                if ($user->activated === null) {
                    $user->activated = true;
                }

                $user->surveys = [];
            }

            foreach (\Surrogate::getAvailableUnlockTypes() as $unlock) {

                $key = str_random(\Surrogate::KEY_LENGTH);

                \Surrogate::create(array(
                    'userid'    =>  $user->userid,
                    'unlock'    =>  $unlock,
                    'key'       =>  $key
                ));

                Session::set(\Surrogate::class . '-' . $unlock, $key);
            }
        });
    }
}
