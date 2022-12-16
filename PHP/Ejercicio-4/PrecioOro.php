<?php
session_start();
if(!isset($_SESSION['oro']))
{
    $_SESSION['oro'] = new PrecioOro();
    $oro= $_SESSION['oro'];
}
else{
    $oro= $_SESSION['oro'];
}
class PrecioOro {
	public $stringDatos;
	public $valor;
	public $datos;
	public $dollar;
	public $euro;
	public $libra;
	public $pulsado;
	 public function __constructor() {
		$this->stringDatos='';
		$this->datos='';
		$this->dollar= '';
		$this->euro= '';
		$this->libra= '';
		$this->pulsado= false;
		$this->valor='Mostrar';
		
	
	 }
public function cargarDatos(){
	if(!$this->pulsado){
		$this->valor='Ocultar';
		$base = "&base=XAU";
		$apikey= "?api_key=4be235104930a5bcac15d85f1d6d5e24";
		$divisas = "&currencies=EUR,USD,GBP";
	
		$url = "https://api.metalpriceapi.com/v1/latest". $apikey . $base . $divisas;
	
		$datos = file_get_contents($url);
		$jsonMaquetado = json_decode($datos, JSON_PRETTY_PRINT);
		$json = json_decode($datos);
		$jsonRates= $json->rates;
		$this->euro=$jsonRates->EUR;
		$this->libra=$jsonRates->GBP;
		$this->dollar=$jsonRates->USD;
		if(isset($json->rates)) {
			$nombre = $json->rates; 
		}
		else{
			$nombre  ="No disponible";
		}
		$this->stringDatos = "<table>";
		$this->stringDatos .= "<thead>";
		$this->stringDatos .="<tbody>";
		$this->stringDatos .="<tr><th>EUROS<th>LIBRAS<th>DOLARES";
		$this->stringDatos .="<tr><td>" .$this->euro."<td>".$this->libra. "<td>" .$this->dollar;
		$this->stringDatos .="</tbody>";
		$this->stringDatos .= "</table>";
		$this->pulsado=true;
	}
	else{
		$this->valor='Mostrar';
		$this->stringDatos='';
		$this->pulsado=false;
	}
}

public function getValor(){
	if($this->pulsado){
		$var =sprintf($this->stringDatos);
		return $var;
		$this->pulsado=false;
	}
	
}
public function getValorBoton(){
	return $this->valor;
	
}
}
if (count($_POST)>0) 
    {   
        if(isset($_POST['datos'])){
         $oro->cargarDatos(); 
        }
	}

echo"
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <title>Precio Del Oro</title>
    <link rel='stylesheet' href='PrecioOro.css' />
</head>

<body>
    
    <h1>Precio Del Oro</h1>
    
	<form action='#' method='post' name='PrecioOro.php'>
		<h2> Datos Precio Oro en Euros, Libras y Dolares </h2>
		<input type='submit' name='datos' value= ".$oro->getValorBoton()."/>
		".$oro->getValor()."
	</form>
</html>";
?>