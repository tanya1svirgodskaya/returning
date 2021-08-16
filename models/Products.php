<?php
include_once ROOT . '/components/Db.php';
class Products
{

    /**
     * Returns an array of categories
     */
    public static function getProductsbyid($ids)
    {

        $db = Db::getConnection();

        $productList = array();

        $result = $db->query("SELECT id_product, product_name FROM product ".
            "where id_product='$ids'".
                 'ORDER BY id_product ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id_product'];
            $productList[$i]['name'] = $row['product_name'];
            $i++;
        }

        return $productList;
    }

}
 
class Psc
{

    /**
     * Returns an array of categories
     */
    public static function getpscbyid( $ids)
    {

        $db = Db::getConnection();

        $productList = array();
         //$ids=int($ids);
        
        $i = 0;
       $sql = "SELECT psc.psc_id, psc.size,c.color_name,pr.id_product,pr.product_name  FROM product as pr  join prod_size_color as psc on pr.id_product= psc.id_product  join color as c on psc.id_color=c.id_color where psc.psc_id in (".implode(',', $ids).")";

        $result = $db->prepare($sql);
        
        
        $result->execute();
        while ($row = $result->fetch()) {

            $productList[$i]['id'] = $row['psc_id'];
            $productList[$i]['product_name'] = $row['product_name'];
            $productList[$i]['product_id'] = $row['id_product'];
            $productList[$i]['color'] = $row['color_name'];
            $productList[$i]['size'] = $row['size'];
            $i++;
        }

        return $productList;
    }

}