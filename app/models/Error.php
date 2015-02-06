<?php

class Error {

    const INVALID_INPUT =   1;
    const RESOURCE_IS_NOT_FOUND =   2;

    private static $_errorMessages = array(
        self::INVALID_INPUT         =>  'Invalid input data',
        self::RESOURCE_IS_NOT_FOUND =>  'The resource with ID is not found'
    );

    /**
     * Returns an error array with error
     * that contains error code and message
     *
     * @param  int   $errorCode
     * @param  mixed $errorData (optional)
     *
     * @return array
     **/
    public static function create($errorCode, $errorData = null)
    {
        if (isset(self::$_errorMessages[$errorCode])) {

            $response = array(
                'code'      =>  $errorCode,
                'message'   =>  self::$_errorMessages[$errorCode]
            );

            if ($errorData != null) {
                $response['data'] = $errorData;
            }

            return $response;
        }

        return array(
            'code'      =>  0,
            'message'   =>  'Unknown error'
        );
    }
} 