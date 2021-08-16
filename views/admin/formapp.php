<?php require 'blocks/headeradmin.php' ?>
<div class="container">
	<div class="form " align="center">
	<form action="#" method="post">

	 <p>Идентификатор возврата:<?php echo $returns[0]['id'] ?><br></p>
   <p class="dline"> Идентификатор заказа:<?php echo $returns[0]['order_id']  ?><br></p>
 <p class="dline"> Идентификатор пользователя:<?php echo $returns[0]['user_id']  ?><br></p>
  <p class="dline">Имя пользователя:<?php echo $returns[0]['username']  ?><br></p>
 <p class="dline"> Дата возрата:<?php echo $returns[0]['data_returning']  ?><br></p>
 <p class="dline">Статус заявки:<?php echo $returns[0]['status_name']  ?><br></p>
 <p class="dline">Причина возврата:<?php echo $returns[0]['reason']  ?><br></p>
  <?php if ( $returns[0]['status_id'] == 2): ?>
 
  <p class="dline">Выберите условие : <select  name="cond_id">
  	
          <?php foreach ($conditionals as $conditional ): ?>
          <option value="<?php echo $conditional['id'] ?>"> <?php echo  $conditional['procent']. '% for'.$conditional['day'].' days'  ;?> </option>
          <?php endforeach ?>
          
      </select> <br></p>

  <?php endif ?>

  <button type="submit" name="button" class="btn btn-success ">Далее</button>

   	   	 </form>
</div>

</div>
</body>
</html>