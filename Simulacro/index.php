<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ruta = $_POST['ruta'];
  switch ($ruta) {
    case 'PizzaCarga':
      include 'PizzaCarga.php';
      break;
    case 'PizzaConsultar':
      include 'PizzaConsultar.php';
      break;
    default:
      echo 'Ruta no válida';
  }
}
?>