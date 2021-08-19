<?php
include_once ROOT . '/models/Products.php';
include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Order.php';
include_once ROOT . '/models/Return.php';
class UserController{

	public function actionProfile(){


		require_once (ROOT.'/views/user/profile.php');
		return true;
	}
	public function actionBought(){
		$us=User::checkLogged();
 		$psc= array();
 		$orders=array();
 		$orders= Order::getuserorders($us);
		$psc=Order::getuserpsc($us);
		//$psc=implode(',', $psc);
		//$psc = explode(",", $psc);
		//$psc=array_walk($psc, 'intval');
		$products=array();
		$products=Psc::getpscbyid($psc);
		$o=array();
		$o= Order::getformdata(10);
		require_once (ROOT.'/views/user/bought.php');
		return true;
	}

	public function actionFormreturn($or_am_id){
		$m=$or_am_id;
		/*$us=User::checkLogged();
 		$psc= array();
 		$orders= Order::getuserorders($us);
		$psc=Order::getuserpsc($us);
		$products=array();
		$products=Psc::getpscbyid($psc);*/
		$order=array();
		$order= Order::getformdata($or_am_id);
		if(isset($_POST['button']))
		{$amount=$_POST['amount'];
		$clothe_state ['tags']=$_POST['tags'];
		$clothe_state ['wearing']=$_POST['wearing'];
		$clothe_state ['defects']=$_POST['defects'];
		$reason=$_POST['reason'];

		Returns::insertreturn($order ,$amount,$clothe_state,$reason);
				header('Location: /bought/');
			}

		require_once (ROOT.'/views/user/formreturn.php');
		return true;
	}
public function actionMessage(){
		$products=array();
		$returns=array();
		$psc=array();
		$us=User::checkLogged();
		$psc=Order::getuserpsc($us);
		$products=Psc::getpscbyid($psc);
		$returns= Returns::getuserreturn($us);
		/*if (isset($_POST['ok']))
			{$return=$_POST['ok'];
			Returns::change_states($return,4);}

		else if (isset($_POST['no'])) {
			$return=$_POST['no'];
			Returns::change_states($return,10);
			# code...
		}*/
		require_once (ROOT.'/views/user/message.php');
		return true;
	}
	public function actionCondition(){
		if (isset($_POST['ok']))
			{$return=$_POST['ok'];
		 Returns::change_states($return,5);
			 header('Location: /messages/');}
		//require_once (ROOT.'/views/user/condition.php');
		return true;
	}

	public function actionNocondition(){
		if (isset($_POST['no']))
			{$return=$_POST['no'];
		 Returns::change_states($return,10);
			 header('Location: /messages/');}


		//require_once (ROOT.'/views/user/condition.php');
		return true;
	}
	public function actionMyreturn()
	{$products=array();

		$psc=array();
		$us=User::checkLogged();
		$returns=array();
		$psc=Order::getuserpsc($us);
		$products=Psc::getpscbyid($psc);
		$returns= Returns::getuserreturn($us);
		require_once (ROOT.'/views/user/myreturn.php');
		return true;
	}
	public function actionRegister(){


		require_once (ROOT.'/views/return/register.php');
		return true;
	}
}
