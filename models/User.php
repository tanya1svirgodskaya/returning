<?php
include_once ROOT . '/components/Db.php';
class User
{

    
    public static function getUserid($login)
    {

        $db = Db::getConnection();
        $sql = 'SELECT id_user FROM user WHERE login = :login ';
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR,30);
        $result->execute();
        $user = $result->fetch();
        if ($user) {
            return $user['id_user'];
        }

        return false;

    }
     public static function auth($userId)
    {   session_start();
        $_SESSION['user'] = $userId;
    }
public static function checkLogged()
    {      session_start();
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        else{return 'noooo';}



}

}
