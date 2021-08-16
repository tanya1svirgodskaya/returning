 <?php require 'blocks/headerreturn.php' ?>
<div class="container">
	<div class="form " align="center">
	<form action="#" method="post">
	 
  
	<p>Идентификатор заказа:<?php echo $order[0]['id_order'] ?><br></p>
   <p class="dline"> Название товара:<?php echo $order[0]['product_name']  ?><br></p>
 <p class="dline"> Категория товара:<?php echo $order[0]['category']  ?><br></p>
  <p class="dline">Цвет:<?php echo $order[0]['color']  ?><br></p>
 <p class="dline"> Размер:<?php echo $order[0]['size']  ?><br></p>
  <p class="dline">Количество даного товара для возврата<input type="number" size="3" name="amount" min="1" max="<?php echo $order[0]['amount']  ?>" value="1"></p>
  <p class="dline"> Наличие бирки : <select  name="tags">
          
          <option selected value="YES">yes</option>
          <option value="NO">no</option>
          
      </select> <br></p>

 <p class="dline"> Поддавалась эксплуатации: <select name="wearing">
         <option selected value="YES">yes</option>
          <option value="NO">no</option>
      </select><br></p>
   
 <p class="dline"> Наличие изначальных дефектов: <select name="defects">
          <option selected value="YES">yes</option>
          <option value="NO">no</option>
      </select><br>
      <input type="text" name="reason" placeholder="Укажите причину возврата и детальное описание дефектов" class="form-control"><br></p>
		<button type="submit" name="button" class="btn btn-success ">Оформить заявку на возврат</button>
   	   	 </form>
</div>

</div>
</body>
</html>