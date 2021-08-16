 <?php require 'layouts/header.php' ?>
 <div class="container mt-5">
 	<style>
   table {
    border: 4px double #333; /* Рамка вокруг таблицы */ 
    border-collapse: separate; /* Способ отображения границы */ 
    width: 100%; /* Ширина таблицы */ 
    border-spacing: 7px 11px; /* Расстояние между ячейками */ 
   }
   td {
    padding: 5px; /* Поля вокруг текста */ 
    border: 1px solid #a52a2a; /* Граница вокруг ячеек */ 
   }
  </style>
 	<table align="center">
  <tr>
    <th>m</th>
   <th>m</th>
   <th>m</th>
  </tr>
  <?php for ($i=0; $i <5 ; $i++) :?>
  	 <tr>
    <td>Breed</td>
    <td>Jack Russell</td>
    <td>Poodle</td>
    <td>Streetdog</td>
    <td> <a class="btn btn-outline-primary" href="/return/">Оформить возврат</a></td>
  </tr>
  
  
 <?php endfor; ?>
</table>
 </div>