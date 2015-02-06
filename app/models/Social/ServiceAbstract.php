<?php

namespace Social;

abstract class ServiceAbstract
{
    /**
     * Returns an user with the ID and service name
     * if exists one, otherwise returns null
     *
     * @param $serviceName
     * @param $userId
     *
     * @return mixed
     **/
    protected function _userExists($serviceName, $userId)
    {
        $user = \User::where('social.' . $serviceName . '.userid', (string) $userId)->get();

        if (count($user)) {
            return $user->first();
        }

        return null;
    }

    /**
     * Makes authorization (and registration if user does not exits)
     *
     * @param $serviceName
     * @param $accountData
     *
     * @return \User
     **/
    protected function _authorizeUser($serviceName, $accountData)
    {
        $user    = null;

        if ($accountData == null) {
            return null;
        }

        if (($user = $this->_userExists(
                $serviceName,
                $accountData['userid'])) == null) {

            $userData = $accountData;
            $userData['social'][$serviceName] = $accountData;

            $user = \User::create($userData);

            // Unset `userid`
            unset($userData['userid']);

            foreach ($userData as $field => $value) {
                $user->{$field} = $value;
            }

            $user->save();
        }

        return $user;
    }
}
