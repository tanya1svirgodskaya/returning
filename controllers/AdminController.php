<?php 
include_once ROOT . '/models/Products.php';
include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Order.php';
include_once ROOT . '/models/Return.php';
class AdminController{

	public function actionApplication(){
		
			$returns=Returns::getreturns();

			$que=array();
			$que=Returns::morereturn();
			foreach ($que as $q){
       
                
                      
                      echo $q['psc_id'];
                      echo $q['product_name'];
                       echo $q['amount_returned']; 
                      }
		require_once (ROOT.'/views/admin/applications.php');
		return true;
	}
	public function actionFormapp($return_id){
			
				$returns=array();
				
		$result=Returns:: check_condition($return_id);
			$conditional=0;

				# code...
			$returns=Returns::getreturnbyid($return_id);
			$conditionals= Conditional::getconditional();
			
			
			if(isset($_POST['button']))
			{$conditional=$_POST['cond_id'];
		 			echo $id_cond. ' '.$return;
					Conditional::updateconditional($conditional,$return_id);
					header('Location: /application/');
				}

		require_once (ROOT.'/views/admin/formapp.php');
		return true;
	}
	public function actionNew($st){
			$returns=array();
							# code...
			$returns=Returns::getnewreturns($st);
			
						

		require_once (ROOT.'/views/admin/app.php');
		return true;
	}
	public function actionChange_statuses($return,$status){
			$returns=array();
							# code...
			Returns::change_states($return,$status);
			
			header('Location:/application/');

		require_once (ROOT.'/views/admin/app.php');
		return true;
	}
	

}