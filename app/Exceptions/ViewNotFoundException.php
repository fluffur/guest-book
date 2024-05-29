<?php

namespace App\Exceptions;

use Exception;

class ViewNotFoundException extends Exception
{
    protected $message = 'View Not Found';
}