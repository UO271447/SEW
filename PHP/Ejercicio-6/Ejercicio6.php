<?php
session_start();
if(!isset($_SESSION['bd']))
{
    $_SESSION['bd']= new BaseDatos();
    $baseDatos= $_SESSION['bd'];
}
else{
    $baseDatos= $_SESSION['bd'];
}
class BaseDatos{
	protected $username ="DBUSER2022";
	protected $server = "localhost";
	protected $password = "DBPSWD2022";
	protected $nombrebasedatos="basedatos";
    protected $datosConsulta=" ";
	
	public function crearBase(){
		$bd = new mysqli($this->server,$this->username,$this->password);
		 if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        else {echo "<p>Conexión establecida con " . $bd->host_info . "</p>";
        }
		$cadena="CREATE DATABASE IF NOT EXISTS basedatos COLLATE utf8_spanish_ci";
		
		if($bd->query($cadena) === TRUE){
            echo "<p>Base de datos creada con éxito</p>";
        }else{
			echo "<p>ERROR en la creación de la Base de Datos. Error: " . $bd->error . "</p>";
            exit();
		}
		$bd->close();
	}
	public function crearTabla(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
            else {
                echo "<p>Conexión establecida con " . $bd->host_info . "</p>";
        }
		$crearT = "CREATE TABLE IF NOT EXISTS PruebasUsabilidad (id INT NOT NULL AUTO_INCREMENT, 
        dni VARCHAR(9) NOT NULL,
        nombre VARCHAR(255) NOT NULL, 
        apellidos VARCHAR(255) NOT NULL,  
        email VARCHAR(255) NOT NULL, 
        telefono INT(9) NOT NULL, 
        edad INT(10) NOT NULL, 
        sexo VARCHAR(255) NOT NULL, 
        pericia_en_informatica INT(10) NOT NULL, 
        tiempo INT(10) NOT NULL, 
        ejercicio_correcto BOOLEAN NOT NULL, 
        comentarios VARCHAR(255) NOT NULL,
        propuestas VARCHAR(255) NOT NULL,
        valoracion INT(10) NOT NULL, 
        PRIMARY KEY (id),
        CONSTRAINT edad_mayor CHECK  (edad >0),
        CONSTRAINT tiempo_mayor CHECK  (tiempo >0),
        CONSTRAINT periciaIn CHECK  (pericia_en_informatica BETWEEN 0 AND 10),
        CONSTRAINT val CHECK  (valoracion BETWEEN 0 AND 10))";
		if($bd->query($crearT) === TRUE){
        echo "<p>Tabla 'PruebasUsabilidad' creada con éxito </p>";
        } else { 
        echo "<p>ERROR en la creación de la tabla PruebasUsabilidad. Error : ". $bd->error . "</p>";
        exit();
        }  
        $bd->close();  
	
	}
	public function isertarDatos(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
            else {
                echo "<p>Conexión establecida con " . $bd->host_info . "</p>";
        } 
        $consulta = $bd->prepare("INSERT INTO PruebasUsabilidad (dni, nombre, apellidos,email,telefono,edad,sexo,pericia_en_informatica,tiempo,ejercicio_correcto,comentarios,propuestas,valoracion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");  
        print_r("aaa");
		$correcto=0;
        if($_POST['correct']=='si'){
           $correcto=1;
       }
	    $sex='Masculino';
		if($_POST['sex']=='Femenino'){
           $sex='Femenino';
       }
	   else if($_POST['sex']=='Otros'){
           $sex='Otros';
       }
	   
        $consulta->bind_param('ssssiisiiissi', 
        $_POST["dni"],$_POST["nombre"], $_POST["apellidos"],$_POST["email"],$_POST["telefono"],$_POST["edad"],
        $sex,$_POST["pericia"],$_POST["tiempo"],$correcto,$_POST["comentarios"],$_POST["propuestas"],$_POST["valoracion"]);   
        $consulta->execute();
        $consulta->close();
        $bd->close();   
    }
	public function buscarDatos(){
        $this->datosConsulta="";
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
            else {
                echo "<p>Conexión establecida con " . $bd->host_info . "</p>";
        } 
        $consulta = $bd->prepare("SELECT * FROM PruebasUsabilidad WHERE ".$_POST['buscar']." = ?");
        if($_POST['buscar']=='valoracion'||$_POST['buscar']=='ejercicio_correcto'||$_POST['buscar']=='tiempo'
        ||$_POST['buscar']=='pericia_en_informatica'||$_POST['buscar']=='edad'||$_POST['buscar']=='telefono'){
        $consulta->bind_param('i', $_POST["buscarr"]); 
        }
        else{
            $consulta->bind_param('s', $_POST["buscarr"]); 
        }
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->fetch_assoc()!=NULL) {
        $resultado->data_seek(0);
            while($fila = $resultado->fetch_assoc()) {
                 $this->datosConsulta.="<p> id = " . $fila["id"] . " dni = " . $fila["dni"] . " nombre = ".$fila['nombre']." apellidos = ". $fila['apellidos'] 
                  ." Email = ". $fila['email'] ." Telefono = ". $fila['telefono'] ." Edad = ". $fila['edad'] ." Sexo = ". $fila['sexo'] .
                  " Pericia Informatica = ". $fila['pericia_en_informatica'] ." Tiempo = ". $fila['tiempo'] ." Ejercicio correcto = ". $fila['ejercicio_correcto'] 
                  ." Comentarios = ". $fila['comentarios'] ." Propuestas = ". $fila['propuestas'] ." Valoracion = ". $fila['valoracion'] ."</p>"; 
              }               
          } else {
            $this->datosConsulta.= "<p>Búsqueda sin resultados</p>";
          }
         
          $consulta->close();
          $bd->close(); 
    }
	public function modificarDatos(){
		 $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
            else {
                echo "<p>Conexión establecida con " . $bd->host_info . "</p>";
        }
		$consulta = $bd->prepare("UPDATE PruebasUsabilidad SET ".$_POST['modificar']." = ? WHERE DNI= ?");
		if($_POST['modificar']=='valoracion'||$_POST['modificar']=='ejercicio_correcto'||$_POST['modificar']=='tiempo'
        ||$_POST['modificar']=='pericia_en_informatica'||$_POST['modificar']=='edad'||$_POST['modificar']=='telefono'){
        
		$consulta->bind_param('is', $_POST["modificarr"],$_POST["dnimodificar"]); 
        
        }
        else{
            $consulta->bind_param('ss', $_POST["modificarr"],$_POST["dnimodificar"]); 
        }
        $consulta->execute();
        $consulta->close();
        $bd->close(); 
		
	}
	public function getResultadoConsulta(){
         return  $this->datosConsulta;
    }
	 public function eliminarDatos(){
        $bd = new mysqli($this->servername,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
            else {
                echo "<p>Conexión establecida con " . $bd->host_info . "</p>";
        } 
        $consulta = $bd->prepare("DELETE FROM PruebasUsabilidad WHERE dni = ?");
        $consulta->bind_param('s', $_POST["dnieliminar"]);    
        $consulta->execute();
        $consulta->close();
        $bd->close(); 
    }
	public function generarInforme(){
    $informe="";
    $bd= new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $npersonas= $bd->query("SELECT count(*) FROM PruebasUsabilidad");
    $npersonas2=$npersonas->fetch_array()[0];
    if($npersonas2!=0){
    

    $redadavg= $bd->query("SELECT avg(edad) FROM PruebasUsabilidad");
    $edadavg=$redadavg->fetch_array()[0];

    $rnsexoF=$bd->query("SELECT count(*) FROM PruebasUsabilidad WHERE sexo = 'Femenino'");
    $nsF=$rnsexoF->fetch_array()[0];
    $nsexoF= ($nsF/ $npersonas2)*100;

    $rnsexoM=$bd->query("SELECT count(*) FROM PruebasUsabilidad WHERE sexo = 'Masculino'");
    $nsexoM= ($rnsexoM->fetch_array()[0]/ $npersonas2)*100;
    $nsexoO=(100-$nsexoF-$nsexoM);

    $rnivel=$bd->query("SELECT avg(pericia_en_informatica) FROM PruebasUsabilidad");
    $nivel=$rnivel->fetch_array()[0];

    $rtiempo=$bd->query("SELECT avg(tiempo) FROM PruebasUsabilidad");
    $tiempo=$rtiempo->fetch_array()[0];

    $rporcentajeCorrecto=$bd->query("SELECT count(*) FROM PruebasUsabilidad WHERE ejercicio_correcto=1");
    $porcentajeCorrecto= ($rporcentajeCorrecto->fetch_array()[0]/ $npersonas2)*100;

    $rvaloramedio=$bd->query("SELECT avg(valoracion) FROM PruebasUsabilidad");
    $valoramedio=$rvaloramedio->fetch_array()[0];
    
    $informe= "<p> Edad media de los usuarios: ". intval($edadavg)." </p>\n";
    $informe.="<p>Frecuencia del % de cada tipo de sexo entre los usuarios: Femenino: ".$nsexoF."% Masculino: ". $nsexoM."% Otro:". $nsexoO."% </p> \n";
    $informe.="<p>Valor medio del nivel o pericia informática de los usuarios: ".$nivel ." </p>\n";
    $informe.="<p>Tiempo medio para la tarea: ".intval($tiempo) ." </p> \n";
    $informe.="<p>Porcentaje de usuarios que han realizado la tarea correctamente: ".$porcentajeCorrecto." </p>\n";
    $informe.="<p>Valor medio de la puntuación de los usuarios sobre la aplicación: ".$valoramedio. "</p>\n";}
    $bd->close(); 
    return $informe;
    }
    public function exportar(){
            $bd= new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        $exp=$bd->query("SELECT * FROM  PruebasUsabilidad");
        $dato= array();
        if($exp->num_rows>0){
            while($row=$exp->fetch_assoc()){
               $dato[]=$row;
            }
        }
         $f = fopen("pruebasUsabilidad.csv", "w");
         $delimiter=";";
        foreach ($dato as $line) {
             fputcsv($f, $line, $delimiter);
        }
      $bd->close();
    }
    public function importar(){
        $bd= new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $f = fopen("pruebasUsabilidad.csv", "r");
    
	while( ($data = fgetcsv($f, 1000, ";") ) !== FALSE )
	{
 
	   $q = "INSERT INTO PruebasUsabilidad (id,dni, nombre, apellidos,email,telefono,edad,sexo,pericia_en_informatica,tiempo,ejercicio_correcto,comentarios,propuestas,valoracion) VALUES (
		'$data[0]', 
		'$data[1]',
		'$data[2]',
        '$data[3]',
        '$data[4]',
        '$data[5]',
        '$data[6]',
        '$data[7]',
        '$data[8]',
        '$data[9]',
        '$data[10]',
        '$data[11]',
        '$data[12]',
        '$data[13]'
	)";
 $bd->query($q);
    }
    fclose($f);
    $bd->close();
  
    }
	
	
	
}
if(count($_POST)>0){
        if(isset($_POST['crear'])){
            $baseDatos->crearBase();
        }
        if(isset($_POST['crearT'])){
            $baseDatos-> crearTabla();
        }
        if(isset($_POST['crearD'])){
            $baseDatos-> isertarDatos();
        }
        if(isset($_POST['buscarD'])){
            $baseDatos-> buscarDatos();
        }
        if(isset($_POST['modificarD'])){
            $baseDatos-> modificarDatos();
        }
        if(isset($_POST['eliminarDni'])){
            $baseDatos-> eliminarDatos();
        }
    }

?>