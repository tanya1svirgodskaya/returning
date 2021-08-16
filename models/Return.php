<?php
include_once ROOT . '/components/Db.php';
class Returns
{


    /**
     * Returns an array of categories

     */
     public static function morereturn()
    {

        $db = Db::getConnection();
       
        $returnList = array();
       
        $sql = "SELECT oa.psc_id , p.product_name,sum(ret.amount_return) as amount_returned FROM `returning` as `ret` join `order_amount` as oa on ret.order_amount_id=oa.order_amount_id join `prod_size_color` as psc on oa.psc_id=psc.psc_id join product as p on psc.id_product=p.id_product
where ret.id_status=6
GROUP by oa.psc_id, p.product_name
order by amount_returned DESC
";
$i=0;
        $result = $db->prepare($sql);
        $result->execute();
        
          while ($row = $result->fetch()) {

            $returnList[$i]['psc_id'] = $row['psc_id'];
            $returnList[$i]['product_name'] = $row['product_name'];
            $returnList[$i]['amount_returned'] = $row['amount_returned'];
            
            $i++;
        }
       return  $returnList;
        
    }
    public static function insertreturn($order,$amount,$id_clothe_state,$reason)
    {
 $id_state=Returns::getclothe_state_id($id_clothe_state);
        $db = Db::getConnection();
        $today = date("Y-m-d");
        
        $productList = array();
       
        $sql = "INSERT INTO `returning`( `order_amount_id`, `amount_return`, `data_returning`, `id_conditional`, `id_clothe_state`, `id_status`, `reason`) VALUES (:order_amount_id,:amount_return,:data_returning,NULL,:id_clothe_state,1,:reason)";

        $result = $db->prepare($sql);
        $result->bindParam(':order_amount_id', $order[0]['order_amount_id'],PDO::PARAM_INT);
        $result->bindParam(':amount_return', $amount,PDO::PARAM_INT);
        $result->bindParam(':reason', $reason,PDO::PARAM_STR);
         $result->bindParam(':id_clothe_state', $id_state,PDO::PARAM_INT);
         $result->bindParam(':data_returning', $today,PDO::PARAM_STR);
          $upsql = "UPDATE `order_amount` SET `amount`=:newamount WHERE `order_amount_id`=:order_amount";
          $newamount=$order[0]['amount'] - $amount;
        $upresult = $db->prepare($upsql);
        $upresult->bindParam(':newamount', $newamount,PDO::PARAM_INT);
        $upresult->bindParam(':order_amount', $order[0]['order_amount_id'],PDO::PARAM_INT);
       $upresult->execute();

       return  $result->execute();
        
    }
    private static function getclothe_state_id($id_clothestate)
    {
      $db = Db::getConnection();

        $sql = "SELECT id_clothe_state FROM `clothe_state` WHERE tag=:tag and wearing = :wearing and defects=:defects";
        $result = $db->prepare($sql);
        $result->bindParam(':tag', $id_clothestate['tags'],PDO::PARAM_STR);
        $result->bindParam(':wearing', $id_clothestate['wearing'],PDO::PARAM_STR);
        $result->bindParam(':defects', $id_clothestate['defects'],PDO::PARAM_STR);
        $result->execute();
        
       $row = $result->fetch();
            
            $clothe_state= $row['id_clothe_state'];

           

       

        return $clothe_state; 
    }
    public static function getreturns( )
    {

        $db = Db::getConnection();

        $returnList = array();
         
        
        $i = 0;
       $sql = "SELECT `id_return`,o.`id_order`,  u.`id_user`, `user_name`, `data_returning`, `status_name`, s.id_status FROM `returning` join `order_amount` on returning.order_amount_id=order_amount.order_amount_id join `order` as o on order_amount.id_order=o.id_order join `user` as u on o.`id_user`=u.id_user join `statuses` as s on `returning`.`id_status`=s.id_status";

        $result = $db->prepare($sql);
        
        
        $result->execute();
        while ($row = $result->fetch()) {

            $returnList[$i]['id'] = $row['id_return'];
            $returnList[$i]['order_id'] = $row['id_order'];
            $returnList[$i]['user_id'] = $row['id_user'];
            $returnList[$i]['username'] = $row['user_name'];
            $returnList[$i]['data_returning'] = $row['data_returning'];
            $returnList[$i]['status_id'] = $row['id_status'];
            $returnList[$i]['status_name'] = $row['status_name'];
            $i++;
        }
        Returns::closereturn(10);

        return $returnList;
    }

     public static function closereturn($status)
    {$db = Db::getConnection();
      $final=array(2,3,5,8 );
      $upsql = "UPDATE `returning` SET `id_status`=:newstatus WHERE `id_status`in (".implode(',', $final).") and  TO_DAYS(NOW()) - TO_DAYS(data_returning) >= 30";
      $upresult = $db->prepare($upsql);
       $upresult->bindParam(':newstatus', $status,PDO::PARAM_INT);
        
        $upresult->execute();
    }
public static function getreturnbyid($id )
    {

        $db = Db::getConnection();

        $returnList = array();
         
        
        $i = 0;
       $sql = "SELECT `id_return`, o.`id_order`,  u.`id_user`, `user_name`, `data_returning`, s.`status_name` , r.`id_status` , `reason` FROM `returning` as r join `order_amount` on r.order_amount_id=order_amount.order_amount_id join `order` as o on order_amount.id_order=o.id_order join `user` as u on o.`id_user`=u.id_user join `statuses` as s on r.`id_status`=s.id_status where `id_return`=:id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id,PDO::PARAM_INT);
        
        $result->execute();
        while ($row = $result->fetch()) {

            $returnList[$i]['id'] = $row['id_return'];
            $returnList[$i]['order_id'] = $row['id_order'];
            $returnList[$i]['user_id'] = $row['id_user'];
            $returnList[$i]['username'] = $row['user_name'];
            $returnList[$i]['data_returning'] = $row['data_returning'];
            $returnList[$i]['status_name'] = $row['status_name'];
            $returnList[$i]['status_id'] = $row['id_status'];
            $returnList[$i]['reason'] = $row['reason'];

            $i++;
        }

        return $returnList;
    }
public static function check_condition($id)
    {
      $neg_clothe_state=array(3,6,7,8);
        $db = Db::getConnection();

        $state = array();
         
        
        $i = 0;
       $sql = "SELECT id_return, data_returning, r.`id_clothe_state`,tag, wearing,defects, id_status FROM `returning` as r JOIN `clothe_state`as c on r.id_clothe_state=c.id_clothe_state  WHERE `id_return`=:id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id,PDO::PARAM_INT);
        
        $result->execute();
        while ($row = $result->fetch()) {

            $state['id'] = $row['id_clothe_state'];
            $state['tag'] = $row['tag'];
            $state['wearing'] = $row['wearing'];
            $state['defects'] = $row['defects'];
             $state['date'] = $row['data_returning'];
              $state['status'] = $row['id_status'];
            
           
        }
        $check=0;

       if ((date_diff(new DateTime(), new DateTime($state['date']))->days)<14 )
       { if (in_array($state['id'],  $neg_clothe_state ) ){
                $check= false;
                echo "Условия не выполены"; }
          
        else {$check= true;
           echo "Условия  выполены";
          }}
          else {$check=false;
           echo "Условия не выполены";}
        Returns::change_state($check,$id, $state['status']);
        return $check;
    }
private static function change_state($result ,$return,$status)
    {

        $db = Db::getConnection();

      $upsql = "UPDATE `returning` SET `id_status`=:newstatus WHERE `id_return`=:return";
      $upresult = $db->prepare($upsql);
        if ($result )
          {
        $status =2;
        $upresult->bindParam(':newstatus', $status,PDO::PARAM_INT);
        $upresult->bindParam(':return', $return,PDO::PARAM_INT);
      
      }
       else {
 
    $status =3;
        $upresult->bindParam(':newstatus', $status,PDO::PARAM_INT);
        $upresult->bindParam(':return', $return,PDO::PARAM_INT);
       
      }
         $upresult->execute();
    }
    public static function change_states($return,$status)
    {$db = Db::getConnection();
      $upsql = "UPDATE `returning` SET `id_status`=:newstatus WHERE `id_return`=:return";
      $upresult = $db->prepare($upsql);
       $upresult->bindParam(':newstatus', $status,PDO::PARAM_INT);
        $upresult->bindParam(':return', $return,PDO::PARAM_INT);
        $upresult->execute();
    }

 public static function getuserreturn($id_user)
  { 
    $returnList=array();
      $db = Db::getConnection();
    $upsql = "SELECT oa.psc_id, r.id_status,s.status_name, r.id_return,r.id_conditional,c.day,c.procent,r.amount_return FROM `returning` as r join `order_amount` as oa on r.order_amount_id=oa.order_amount_id join `order` as o on oa.id_order=o.id_order join `conditional` as c on r.id_conditional=c.id_conditional join `statuses` as s on r.`id_status`=s.`id_status` where o.id_user=:id_user";
        $upresult = $db->prepare($upsql);
        $upresult->bindParam(':id_user', $id_user,PDO::PARAM_INT);
               $upresult->execute();
               $i=0;
               while ($row = $upresult->fetch()) {

            $returnList[$i]['id'] = $row['id_return'];
            $returnList[$i]['psc_id'] = $row['psc_id'];
            $returnList[$i]['id_cond'] = $row['id_conditional'];
            $returnList[$i]['day'] = $row['day'];
            $returnList[$i]['procent'] = $row['procent'];
            $returnList[$i]['status'] = $row['id_status'];
            $returnList[$i]['status_name'] = $row['status_name'];
           $returnList[$i]['amount'] = $row['amount_return'];

            $i++;
        }

        return $returnList;

       
  }
  public static function getnewreturns($id_status )
    {

        $db = Db::getConnection();

        $returnList = array();
         
        
        $i = 0;
       $sql = "SELECT `id_return`,o.`id_order`,  u.`id_user`, `user_name`, `data_returning`, `status_name`, s.id_status FROM `returning` join `order_amount` on returning.order_amount_id=order_amount.order_amount_id join `order` as o on order_amount.id_order=o.id_order join `user` as u on o.`id_user`=u.id_user join `statuses` as s on `returning`.`id_status`=s.`id_status` where   `returning`.`id_status`=:id_status order by `id_return`";

        $result = $db->prepare($sql);
         $result->bindParam(':id_status', $id_status,PDO::PARAM_INT);
        
        $result->execute();
        while ($row = $result->fetch()) {

            $returnList[$i]['id'] = $row['id_return'];
            $returnList[$i]['order_id'] = $row['id_order'];
            $returnList[$i]['user_id'] = $row['id_user'];
            $returnList[$i]['username'] = $row['user_name'];
            $returnList[$i]['data_returning'] = $row['data_returning'];
            $returnList[$i]['status_id'] = $row['id_status'];
            $returnList[$i]['status_name'] = $row['status_name'];
            $i++;
        }

        return $returnList;
    }

}
 /**
  * 
  */
 class Conditional
 {
   
  public static function getconditional()
  {
      $db = Db::getConnection();
        $conditionalList = array();

        $result = $db->query(" SELECT * FROM `conditional`");

        $i = 0;
        while ($row = $result->fetch()) {
            $conditionalList[$i]['id'] = $row['id_conditional'];
            $conditionalList[$i]['day'] = $row['day'];
            $conditionalList[$i]['procent'] = $row['procent'];
            
            $i++;
        }

        return $conditionalList;

  }
  public static function updateconditional($id_cond ,$return)
  { echo $id_cond. ' '.$return;
    if ($id_cond!=0)
      {$db = Db::getConnection();
    $upsql = "UPDATE `returning` SET `id_conditional`=:id_cond WHERE `id_return`=:return";
        $upresult = $db->prepare($upsql);
        $upresult->bindParam(':id_cond', $id_cond,PDO::PARAM_INT);
        $upresult->bindParam(':return', $return,PDO::PARAM_INT);
       $upresult->execute();

       return  $upresult->execute();}


  }

 
 }