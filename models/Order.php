<?php
include_once ROOT . '/components/Db.php';
class Order
{

    /**
     * Returns an array of categories
     */
    public static function getuserpsc($userid)
    {

        $db = Db::getConnection();

        
        $orders = array();
        $ps = array();

        $result = $db->query("SELECT o.`id_order` as `id_order`, `oa`.`order_amount_id` as `id_or_am`, oa.`psc_id` as `psc_id`,oa.`amount` as `amount` FROM `order`  as o JOIN `order_amount` as oa on o.id_order=oa.id_order".
            " where o.id_user='$userid'".
                 'ORDER BY id_order DESC');

        $i = 0;
        while ($row = $result->fetch()) {
            
            $ps[$i]= $row['psc_id'];

            $i++;

        }

        return $ps;
    }
public static function getuserorders($userid)
    {

        $db = Db::getConnection();

        
        $orders = array();
        $ps = array();

        $result = $db->query("SELECT o.`id_order` as `id_order`,o.`data_order` as `data_order`, `oa`.`order_amount_id` as `id_or_am`, oa.`psc_id` as `psc_id`,oa.`amount` as `amount` FROM `order`  as o JOIN `order_amount` as oa on o.id_order=oa.id_order".
            " where o.id_user='$userid'".
                 'ORDER BY id_order DESC');

        $i = 0;
        while ($row = $result->fetch()) {
            $orders[$i]['id'] = $row['id_order'];
            $orders[$i]['order_amount'] = $row['id_or_am'];
            $orders[$i]['psc'] = $row['psc_id'];
            $orders[$i]['amount'] = $row['amount'];
             $orders[$i]['date'] = $row['data_order'];
            

            $i++;

        }

        return $orders;
    }
    
    public static function getformdata($order_amount_id)
    {

        $db = Db::getConnection();

        
        $formdata = array();
        
        $sql = "SELECT oa.order_amount_id ,oa.id_order as id_order, p.product_name as product_name,c.category_name,col.color_name,psc.size,oa.amount 
        FROM  order_amount as oa JOIN prod_size_color as psc on oa.psc_id=psc.psc_id join product as p on psc.id_product=p.id_product join category as c on p.id_category=c.id_category join  color as col on psc.id_color=col.id_color where oa.order_amount_id= :order_amount_id ";
        $result = $db->prepare($sql);
        $result->bindParam(':order_amount_id', $order_amount_id,PDO::PARAM_INT);
         $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $formdata[$i]['order_amount_id']=$row['order_amount_id'];
            $formdata[$i]['id_order'] = $row['id_order'];
            $formdata[$i]['category'] = $row['category_name'];
            $formdata[$i]['product_name'] = $row['product_name'];
            $formdata[$i]['amount'] = $row['amount'];
            
             $formdata[$i]['color'] = $row['color_name'];
             $formdata[$i]['size'] = $row['size'];
            

            $i++;

        }

        return $formdata;
    }

}



