  <?php require 'blocks/header.php' ?>
  <div class='container mt-5'>
  <h3 class = 'mb-5'>Новинки</h3>
  	<div class='d-flex flex-wrap'>
  		<?php 
  		for ($i=0;$i<6;$i++):
  		?>
  	<div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">NEW</h4>
      </div>
      <div class="card-body">
        <img src="img/<?php echo($i+1)?>.jpg" class='img-thumbnail'>
        <h1 class="card-title pricing-card-title"><?php echo(($i+1)*100 + 50) ?> </h1>
        <ul class="list-unstyled mt-3 mb-4">
          
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Купить</button>
      </div>
  </div>
  <?endfor;?>
    </div>
  
</div>
</body>
</html>
