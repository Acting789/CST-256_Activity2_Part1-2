<?php
namespace App\Services\Business;

use \PDO;
use App\Models\UserModel;
use Illuminate\Support\Facades\Log;
use App\Services\Data\SecurityDAO;

class SecurityService
{
    //REFACTOR: this should be renamed to authinticate()
    public function login(UserModel $user){
        
        Log::info("Entering SecurityService.login()");
        
        //BEST PRATICES: externalise your application configerutation get craditals for accessing the database
        //REFACTOR: the initialization code is required in all the business methoods
        $servername = config("databse.connections.mysql.host");
        $port = config("databse.connections.mysql.port");
        $username = config("databse.connections.mysql.username");
        $password = config("databse.connections.mysql.password");
        $dbname = config("databse.connections.mysql.database");
        
        //BEST PRATICE: Do Not create database connections in a DAO (So you can support Atomic Database Tranasations) 
        //create connection
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //craete a Security serice DAO with this connection and try to find the password in the user.
        $service = new SecurityDAO($db);
        $flag = $service->findByUser($user);
        
        // IN PDO you "CLOSE" that databse connection by setting the PDO object to null
        $db = null;
        
        //return the finder results
        Log::info("Exit SecurityService() with: " . $flag);
        return $flag;
    }
}

