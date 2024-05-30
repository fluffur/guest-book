<?php

namespace App\Exceptions\Auth;

use Exception;

class UsernameTakenException extends Exception
{
    protected $message = 'Username already taken';
}