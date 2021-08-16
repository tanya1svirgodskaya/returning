<?php require 'blocks/headerreturn.php' ?>
 <div class="container">
 	<h1>Мои возвраты</h1>
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
   <th>Идентификатор возврата</th>
    <th> Название товара</th>
    <th> Цвет</th>
    <th> Размер</th>
<th> Количество</th>
   <th>Статус</th>
   
  </tr><?php foreach ($returns as $return): ?>
 
  
        <?php foreach ($products as $product): ?>
            <?php if ( $return['psc_id'] == $product ['id']): ?>
                <tr> <div class="mycontainer">
                      
                      <td><?php echo $return['id']; ?></td>
                      <td><?php echo $product['product_name']; ?></td>
                      <td><?php echo $product['color']; ?></td>
                      <td><?php echo $product['size']; ?></td>
                      <td><?php echo $return['amount']; ?></td>
                      <td><?php echo $return['status_name']; ?></td>
                      
            </tr>
                     <?php endif ;?> 

      <?php endforeach; ?>
      <?php endforeach ;?>
</table>
   
   
</div>


</body>
</html>        

 </div>