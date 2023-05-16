<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ruta = $_POST['ruta'];
  switch ($ruta) {
    case 'HamburguesaCarga':
      include 'HamburguesaCarga.php';
      break;
    case 'HamburguesaConsultar':
      include 'HamburguesaConsultar.php';
      break;
    case 'AltaVenta':
      include 'AltaVenta.php';
      break;
    case 'ConsultasVentas':
      include 'ConsultasVentas.php';
      break;
    case 'DevolverHamburguesa':
      include 'DevolverHamburguesa.php';
      break;
    default:
      echo 'Ruta no válida';
  }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
  include 'ModificarVenta.php';
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  include 'BorrarVenta.php';
}
