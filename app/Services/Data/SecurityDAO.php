<?php
namespace App\Services\Data;

use \PDO;
use PDOException;
use App\Services\Utility\DatabaseException;
use App\Models\UserModel;
use Illuminate\Support\Facades\Log;

class SecurityDAO
{
    private $db = NULL;
    
    //BEST PRATICE: Do not create database connections in a Data Service
    public function __construct($db){
        $this->db = $db;
    }
    
    public function findByUser(UserModel $user){
        Log::infor("Entering SecurityDAO.findByUser()");
        
        try{
            //select username and password and see if fow exsists
            $name = $user->getUsername();
            $pw = $user->getPassword();
            $stmt = $this->db->prepare('SELECT ID, USERNAME, PASSWORD FROM USERS WHERE USERNAME = :username AND PASSWORD = :password');
            $stmt->bindParam(':username', $name);
            $stmt->binfParam(':password', $pw);
            $stmt->execute();
            
            //see if user exists and return true if found else return false if not found
            //BAD PRATICE: This is business rules in our DAO
            //GOOD PRATICE: simply return the row count, and make the logic above you
            if ($stmt->rowCount() == 1){
                Log::info("Exit SecurityDAO.findByUser() with true");
                return true;
            } else {
                Log::info("Exit SecurityDAO.findByUser() with false");
                return false;
            }
            
        } catch (PDOException $e){
            //BEST PRATICE: Catch All ecteptions (Do not swallow exceptions), log the exception, do not throw technology spesfic exception, and throw a custom exceprion
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        } 
    }
}

