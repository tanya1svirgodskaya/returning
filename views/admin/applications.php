 <?php require 'blocks/headeradmin.php' ?>
 <div class="container">
    <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="/new/1">Новые</a>
    <a class="p-2 text-dark" href="/new/5">Ожидание  товара</a>
    <a class="p-2 text-dark" href="/new/6">На еспертизе</a>
    <a class="p-2 text-dark" href="/new/9">Возврат средств</a>

    
  </nav>
 </div>
 <h1>Заявки на возврат</h1>
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
   <th>Идентификатор заявки</th>
    <th>Идентификатор заказа</th>
   <th>Идентификатор пользователя</th>

   <th>Имя пользователя</th>
   <th>Дата оформления заявки</th>
   <th>Статус</th>
  </tr>
 
  <?php foreach ($returns as $return): ?>
       
                <tr> <div class="mycontainer">
                      
                      <td><?php echo $return['id']; ?></td>
                      <td><?php echo $return['order_id']; ?></td>
                      <td><?php echo $return['user_id']; ?></td>
                      <td><?php echo $return['username']; ?></td>
                      <td><?php echo $return['data_returning']; ?></td>
                      <td><?php echo $return['status_name']; ?></td>
           
                      <td>  <?php if ( $return['status_id'] == 1): ?>               
                           <a href="/admin/app/<?php echo $return['id']?>" class="btn btn-outline-primary"><i class="fa fa-shopping-cart"></i>Обработать заявку</a>
                                            </div>  
                                            <?php elseif ( $return['status_id'] == 5): ?>               
                           <a href="/admin/statuses/<?php echo $return['id']?>/6" class="btn btn-outline-primary"><i class="fa fa-shopping-cart"></i>На экспертизе</a>
                           <a href="/admin/statuses/<?php echo $return['id']?>/10" class="btn btn-outline-primary"><i class="fa fa-shopping-cart"></i>Завершено</a>


                                            </div>   
                                            <?php elseif ( $return['status_id'] == 6): ?>               
                           <a href="/admin/statuses/<?php echo $return['id']?>/9" class="btn btn-outline-primary"><i class="fa fa-shopping-cart"></i>Возврат средств</a>
                           <a href="/admin/statuses/<?php echo $return['id']?>/8" class="btn btn-outline-primary"><i class="fa fa-shopping-cart"></i>Отменено по данным экспертизы</a>
                                            </div>     
                                            <?php elseif ( $return['status_id'] == 9): ?>               
                           <a href="/admin/statuses/<?php echo $return['id']?>/10" class="btn btn-outline-primary"><i class="fa fa-shopping-cart"></i>Завершено</a>
                          
                                            </div>             
                                <?php endif ?> 
                         </td>
                   
            </tr>

      <?php endforeach ;?>
</table>/
/
/
/
/

   <table align="center" >
 <tr>
   <th>Идентификатор Товара</th>
    <th>Название товара</th>
   <th>Количество возвратов товара</th>

  
  </tr>
 
  <?php foreach ($que as $q): ?>
       
                <tr> <div class="mycontainer">
                      
                      <td><?php echo $q['psc_id']; ?></td>
                      <td><?php echo $q['product_name']; ?></td>
                      <td><?php echo $q['amount_returned']; ?></td>
                      
           
                     
            </tr>

      <?php endforeach ;?>
</table>
   
   
</div>


</body>
</html>     