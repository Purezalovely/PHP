<?php
class database
{
 function opencon(){
return new PDO ('mysql:host=localhost;dbname=loginmethod','root', '');
}
    function check($username, $password){
$con=$this->opencon();
$query = "SELECT * from users WHERE username='".$username."'&& passwords='".$password."'";
return  $con->query($query)->fetch();
 
    }
    function signup($username, $password, $firstname, $lastname, $birthday, $sex){
        $con = $this->opencon();
        $query = $con->prepare("SELECT username FROM users WHERE username = ?");
        $query->execute([$username]);
        $existingUser = $query->fetch();
 
        if ($existingUser){
            return false;
        }
        return $con->prepare("INSERT INTO users (username, passwords, Firstname, Lastname, birthday, sex) VALUES (?,?,?,?,?,?)")->execute([$username, $password, $firstname, $lastname, $birthday, $sex]);
    }
    function signupUser($username, $password, $firstName, $lastName, $birthday, $sex) {
        $con = $this->opencon();
   
        $query = $con->prepare("SELECT username FROM users WHERE username = ?");
        $query->execute([$username]);
        $existingUser = $query->fetch();
        if ($existingUser){
            return false;
        }
        $query = $con->prepare("INSERT INTO users (username, passwords, Firstname, Lastname, birthday, sex) VALUES (?, ?, ?, ?, ?,?)");
        $query->execute([$username, $password, $firstName, $lastName, $birthday,$sex]);
        return $con->lastInsertId();
    }function insertAddress($user_id, $city, $province, $street, $barangay) {
        $con = $this->opencon();
        return $con->prepare("INSERT INTO user_address (user_id, user_add_city, user_add_province, user_add_street, user_add_barangay) VALUES (?, ?, ?, ?, ?)")
            ->execute([$user_id, $city, $province, $street, $barangay]);
    }
}
 