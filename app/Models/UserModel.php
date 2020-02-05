<?php

namespace App\Models;

//refactor: this should be renamed to CredentalModel
class UserModel implements \JsonSerializable
{
    //private $id;
    private $username;
    private $password;
    
    //BEST PRATICE: User a non-default constrocuot for object models
    public function __construct($username, $password){
        //$this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * BEST PRATICE: Just implement getter (read-only) accessord fo Object models
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * BEST PRATICE: Just implement getter (read-only) accessord fo Object models
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


}