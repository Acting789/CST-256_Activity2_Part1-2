<?php
namespace App\Services\Utility;

use Exception;

class DatabaseException
{
    //non default constroctor
    public function __construct($message, $code = 0, Exception $previous = null){
        //call super class
        parent::__construct(Message, $code, $previous);
    }
}

