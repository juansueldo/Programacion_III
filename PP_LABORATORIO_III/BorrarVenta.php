<?php
include "./Clases/Venta.php";

$listaDeVentas = array();
$listaDeJSON = Archivos::LeerArchivoJSON("./Archivos/Venta.json");

$datos = json_decode(file_get_contents("php://input"), true);

if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $ventaJson)
    {
        $ventaAuxiliar = new Venta ($ventaJson["mail"],
        $ventaJson["nombreHamburguesa"],$ventaJson["tipoHamburguesa"],$ventaJson["aderezoHamburguesa"],$ventaJson["cantidadHamburguesa"]);
        $ventaAuxiliar->id = $ventaJson['id'];
        $ventaAuxiliar->fechaPedido = $ventaJson['fechaPedido'];
        $ventaAuxiliar->numeroPedido = $ventaJson['numeroPedido'];
        array_push($listaDeVentas,$ventaAuxiliar);
    }
}

for ($i=0; $i < count($listaDeVentas); $i++) { 
    if(strcmp($listaDeVentas[$i]->numeroPedido,$datos["numeroPedido"])==0){
        moverImagen($listaDeVentas[$i]);
        unset($listaDeVentas[$i]);
        break;
    }
}


function moverImagen($venta) {
    $mailSeparado = explode("@",$venta->mail); 
    $archivo = $venta->tipoHamburguesa . '_' . $venta->nombreHamburguesa . '_' . $mailSeparado[0] . '_' . $venta->fechaPedido;
    $ruta_origen = "./ImagenesDeLaVenta/" . $archivo .  ".jpg";
    $ruta_destino = "./BACKUPVENTAS/" . $archivo . ".jpg";

    // Verificar si la imagen existe en el directorio origen
    if (!file_exists($ruta_origen)) {
        echo "La imagen $archivo no existe en el directorio $ruta_origen.";
        return;
    }

    // Mover la imagen al directorio destino
    if (rename($ruta_origen, $ruta_destino)) {
        echo "La imagen $archivo ha sido movida del directorio $ruta_origen al directorio $ruta_destino.";
    } else {
        echo "Ha ocurrido un error al intentar mover la imagen $archivo del directorio $ruta_origen al directorio $ruta_destino.";
    }
}

Archivos::guardarObjetoJSON("./Archivos/Venta.json",$listaDeVentas);
