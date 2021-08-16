 <?php require 'blocks/headerreturn.php' ?>


   
          <style>
   table {
    border: 4px double #333; /* Рамка вокруг таблицы */ 
    border-collapse: separate; /* Способ отображения границы */ 
    width: 60%; /* Ширина таблицы */ 
    border-spacing: 7px 11px; /* Расстояние между ячейками */ 
   }
   td {
    padding: 5px; /* Поля вокруг текста */ 
    border: 1px solid #a52a2a; /* Граница вокруг ячеек */ 
   }
  </style>
<table align="center" >
 <tr>
   <th>Идентификатор заказа</th>
    <th>Идентификатор</th>
   <th>Название</th>
   <th>Цвет</th>
   <th>Размер</th>
  </tr>
 
  <?php foreach ($orders as $order): ?>
        <?php foreach ($products as $product): ?>
            <?php if ( $order['psc'] == $product ['id']): ?>
                <tr> <div class="mycontainer">
                      
                      <td><?php echo $order['id']; ?></td>
                      <td><?php echo $product['id']; ?></td>
                      <td><?php echo $product['product_name']; ?></td>
                      <td><?php echo $product['color']; ?></td>
                      <td><?php echo $product['size']; ?></td>
                      <?php if ( $order['amount'] != 0): ?>
                      <td>                 
                           <a href="/user/product/<?php echo $order['order_amount']?>" class="btn btn-outline-primary"><i class="fa fa-shopping-cart"></i>Оформить возврат</a>
                                            </div>         
                         </td>
                    <?php endif ;?>
            </tr>
<?php endif ;?>
      <?php endforeach; ?>
      <?php endforeach ;?>
</table>
   
   
</div>


</body>
</html>        

                                                  

                                         
                     