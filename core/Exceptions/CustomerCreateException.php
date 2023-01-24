<?php

namespace Core\Exceptions;

use Exception;

class CustomerCreateException extends Exception
{
    protected $message = 'Already Existing Customer. Check on your trashed companies and restore the company';
}
