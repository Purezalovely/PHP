<?php
class database
{
 function opencon(){
return new PDO ('mysql:host=localhost;dbname=loginmethod','root', '');
}  
    function check($username, $password){
$con=$this->opencon();
$query = "SELECT * from userss WHERE username='".$username."'&& passwords='".$password."'";
return  $con->query($query)->fetch();
 
    }
    function signup($username, $password, $firstname, $lastname, $birthday, $sex){
        $con = $this->opencon();
        $query = $con->prepare("SELECT username FROM userss WHERE username = ?");
        $query->execute([$username]);
        $existingUser = $query->fetch();
 
        if ($existingUser){
            return false;
        }
        return $con->prepare("INSERT INTO userss (username, passwords, Firstname, Lastname, birthday, sex) VALUES (?,?,?,?,?,?)") ->execute([$username, $password, $firstname, $lastname, $birthday, $sex]);
    }
    function signupUser($username, $password, $firstName, $lastName, $birthday, $sex) {
        $con = $this->opencon();
   
        $query = $con->prepare("SELECT username FROM userss WHERE username = ?");
        $query->execute([$username]);
        $existingUser = $query->fetch();
        if ($existingUser){
            return false;
        }
        $query = $con->prepare("INSERT INTO userss (username, passwords, firstname, lastname, birthday, sex) VALUES (?, ?, ?, ?, ?,?)");
        $query->execute([$username, $password, $firstName, $lastName, $birthday, $sex]);
       return $con->lastInsertId();
    }function insertAddress($user_id, $city, $province, $street, $barangay) {
        $con = $this->opencon();
        return $con->prepare("INSERT INTO user_addresss (user_id, user_add_city, user_add_province, user_add_street, user_add_barangay) VALUES (?, ?, ?, ?, ?)")
            ->execute([$user_id, $city, $province, $street, $barangay]);
    }

    function view ()
    {
        $con = $this->opencon();
        return $con->query("SELECT userss.user_id, userss.username, userss.passwords, userss.firstname, userss.lastname, userss.birthday, userss.sex, CONCAT(user_addresss.user_add_street,' ', user_addresss.user_add_barangay,' ', user_addresss.user_add_city,' ', user_addresss.user_add_province) AS address FROM userss JOIN user_addresss ON userss.user_id=user_addresss.user_id;")
        ->fetchALL();
    }
    function delete($id)
    {
        try {
            $con = $this->opencon();
            $con->beginTransaction();
 
            $qeury = $con->prepare("DELETE FROM user_address WHERE user_id =?");
            $qeury->execute([$id]);
 
            $query2 = $con->prepare("DELETE FROM user WHERE user_id =?");
           
            $con->commit();
            return true;
        } catch(PDOException $e) {
            $con->rollBack();
            return false;
        }
    }

    function viewdata($id){
        try{
            $con = $this->opencon();
            $query = $con->prepare("SELECT userss.user_id, userss.username, userss.passwords, userss.firstname, userss.lastname, userss.birthday, userss.sex, CONCAT(user_addresss.user_add_street,' ', user_addresss.user_add_barangay,' ', user_addresss.user_add_city,' ', user_addresss.user_add_province) AS address FROM userss JOIN user_addresss ON userss.user_id=user_addresss.user_id;WHERE userss.user_id = ?");
            $query->execute([$id]);
            return $query->fetch();
        } catch(PDOException $e) {
            return[];
        }
    }

    function UpdateUser($user_id, $firstname, $lastname, $birthday, $sex, $username, $password){
        try{
            $con = $this->opencon();
            $con->beginTransaction();
            $query = $con->prepare("UPDATE userss SET user_Firstname=?,user_Lastname=?,user_birthday=?,user_sex=?,user_name=?,user_pass=? WHERE user_id=?");
            $query->execute([$firstname, $lastname, $birthday, $sex, $username, $password, $user_id]);

            $con->commit();
        } catch(PDOException $e) {
            $con->rollBack(); 
            return false;  
    }
  
}

function UpdateUserAddress($user_id, $street, $barangay, $city, $province,){
    try{
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE userss SET user_street=?,user_barangay=?,user_city=?,user_province=?, WHERE user_id=?");
        $query->execute([$user_id, $street, $barangay, $city, $province,]);

        $con->commit();
    } catch(PDOException $e) {
        $con->rollBack(); 
        return false;  
}
}
}