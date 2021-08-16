<?php 
include_once ROOT . '/models/User.php';
class ReturnController{
	public function actionReturn()
 {
        $login = '';
        $password = '';
       if(isset($_POST['button']))
       	   { $login = $_POST['login'];
            $password = $_POST['password'];
             $userId= User:: getUserid($login);
              User::auth($userId);
                
              if ($userId==3) {
           header("Location:/application/");
                 
                exit;
              }
              else if (!$userId) {
               header("Location:/register/"); # code...
              }
              else   {
          
           header("Location:/user/"); 
           }}
  require_once(ROOT . '/views/return/return.php');

        return true;

        }
        

        
    
}