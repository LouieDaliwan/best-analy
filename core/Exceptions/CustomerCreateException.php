<?php

namespace Core\Exceptions;

use Exception;

class CustomerCreateException extends Exception
{
    protected $message = 'The company is in Trashed Companies. Contact your SME Ratings administrator to restore or permanently delete the company, then try to click Start again.';
}
