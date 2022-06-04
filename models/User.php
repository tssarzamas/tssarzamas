<?php

class User
{
    public static function register($email, $password, $name) {
        
        $db = Db::getConnection();
       
        $rights = 'p';
        $pass = md5($password);
        $address = 'не указан';
        $phone = 'не указан';
        // echo "$name <br> $email <br> $password - $pass <br> rights - $rights <br> $address <br> phone - $phone";

        $sql = "INSERT INTO users (email, password, name, rights, address, phone) VALUES (:email, :password, :name, :rights, :address, :phone)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $pass, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);       
        $result->bindParam(':rights',  $rights, PDO::PARAM_STR);
        $result->bindParam(':address',  $address, PDO::PARAM_STR);
        $result->bindParam(':phone',  $phone, PDO::PARAM_STR);       
        
        return $result->execute();
    }
    
    /* Проверяет имя: не меньше, чем 2 символа*/
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    
    /*Проверяет $password: не меньше, чем 6 символов*/
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    
    /* Проверяет email */
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    public static function checkEmailExists($email) {
        
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM users WHERE email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }
    
    /*
     * Редактирование данных пользователя
     */
    public static function edit($userId, $name, $address, $phone)
    {
        $db = Db::getConnection();
        
        // $sql = "UPDATE users SET name = $name, address = $address WHERE ID_user = $userId";
        if ($address=='') {$address='не указан';};
        if ($phone=='') {$phone='не указан';};
        $sql = "UPDATE users 
            SET name = :name, address = :address , phone = :phone 
            WHERE ID_user = :id";
        
        $result = $db->prepare($sql);                                  
        $result->bindParam(':id', $userId, PDO::PARAM_INT);       
        $result->bindParam(':name', $name, PDO::PARAM_STR);    
        $result->bindParam(':address', $address, PDO::PARAM_STR);
         $result->bindParam(':phone', $phone, PDO::PARAM_STR);  
        return $result->execute();
    }
    

    /*
     * Проверяем существует ли пользователь с заданными $email и $password
     */
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $pass= md5($password);

        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $pass, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();  
        
        if ($user) {           
            return $user['ID_user'];
        }

        return false;
    }

    /* Запоминаем пользователя   */
    public static function auth($userId)
    {          
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    { 
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    public static function isGuest()
    {  
        if (isset($_SESSION['user'])) {           
            return false;
        }

        return true;
    }

    /* Returns user by id */
    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM users WHERE ID_user = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();


            return $result->fetch();
        }
    }

    // check phone
     public static function checkPhone($phone)
    {   

        if (strlen($phone) == 17) {
            return true;
        }
        return false;
    }

 


}