 <?php require 'blocks/headerreturn.php' ?>
 <div class="container">
 	<h1>Уведомления</h1>
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

   <th>Условие</th>
   
  </tr><?php foreach ($returns as $return): ?>
 <?php if ( $return['status'] ==2 ): ?>
  
        <?php foreach ($products as $product): ?>
            <?php if ( $return['psc_id'] == $product ['id']): ?>
                <tr> <div class="mycontainer">
                      
                      <td><?php echo $return['id']; ?></td>
                      <td><?php echo $product['product_name']; ?></td>
                      <td><?php echo $product['color']; ?></td>
                      <td><?php echo $product['size']; ?></td>
                      <td><?php echo $return['procent'].' % for '. $return['procent'].' day(s)'; ?></td>
                      <td> 
						
                       <form action ='#'  method="post">
                      	 <button type="submit"  name="ok" value='<?php echo $return['id']; ?>' class="btn btn-success "formaction="/user/condition/" >Принять</button></form>
                      	 <form action ='#' method="post">
                      	  <button type="submit"  name="no" value='<?php echo $return['id']; ?>' class="btn btn-success " formaction="/user/nocondition/">Отклонить</button></form>
                      
                                           

                         </td>
            </tr>
                     <?php endif ;?> 

      <?php endforeach; ?><?php endif ;?>
      <?php endforeach ;?>
</table>
   
   
</div>


</body>
</html>        

 </div>