<?php
ini_set('auto_detect_line_endings',TRUE);
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
	protected $nombrebasedatos="basedatos7";
    protected $datosConsulta=" ";
	
	public function crearBase(){
		$bd = new mysqli($this->server,$this->username,$this->password);
		 if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        else {echo "<p>Conexión establecida con " . $bd->host_info . "</p>";
        }
		$cadena="CREATE DATABASE IF NOT EXISTS basedatos7 COLLATE utf8_spanish_ci";
		
		if($bd->query($cadena) === TRUE){
            echo "<p>Base de datos creada con éxito</p>";
        }else{
			echo "<p>ERROR en la creación de la Base de Datos. Error: " . $bd->error . "</p>";
            exit();
		}
		$bd->close();
		$this->crearTablaE();
		$this->crearTablaC();
		$this->crearTablaJ();
		$this->crearTablaT();
		$this->crearTablaP();	
	}
	public function crearJ()
    {
        $bd = new mysqli($this->server, $this->username, $this->password, $this->nombrebasedatos);
        if ($bd->connect_error) {
            exit("<p>ERROR de conexión:" . $bd->connect_error . "</p>");
        } 
        $c=$_POST['nombreCre'];
        $rcreador = $bd->query("SELECT id FROM Creador where nombre ='$c'");
        $creador = mysqli_fetch_array($rcreador)[0];
        $consulta = $bd->prepare("INSERT INTO Juego (nombre,saga,fechaestreno,trailer,id_creador) VALUES (?,?,?,?,?)");
        $consulta->bind_param('sssis',
            $_POST["nombreJu"], $_POST["saga"], $_POST["fechaEstreno"], $_POST["trailer"],$creador);
        $consulta->execute();
        $consulta->close();
        $bd->close();
    }
	public function crearC()
    {
        $bd = new mysqli($this->server, $this->username, $this->password, $this->nombrebasedatos);
        if ($bd->connect_error) {
            exit("<p>ERROR de conexión:" . $bd->connect_error . "</p>");
        } 
        $c=$_POST['empresa'];
        $remp = $bd->query("SELECT id FROM Empresa where nombre ='$c'");
        $emp = mysqli_fetch_array($remp)[0];
        $consulta = $bd->prepare("INSERT INTO Creador (nombre,apellidos,fechaNacimiento,id_empresa) VALUES (?,?,?,?)");
        $consulta->bind_param('ssss',
            $_POST["nombreC"], $_POST["apellidoC"], $_POST["fechaNaci"],$emp);
        $consulta->execute();
        $consulta->close();
        $bd->close();
    }
	public function crearE()
    {
        $bd = new mysqli($this->server, $this->username, $this->password, $this->nombrebasedatos);
        if ($bd->connect_error) {
            exit("<p>ERROR de conexión:" . $bd->connect_error . "</p>");
        } 
        $consulta = $bd->prepare("INSERT INTO EMPRESA (nombre,inicio,fundador) VALUES (?,?,?)");
        $consulta->bind_param('sss',$_POST["nombreE"], $_POST["inicioE"], $_POST["fundadorE"]);
        $consulta->execute();
        $consulta->close();
        $bd->close();   
    }
	public function getDatosConsulta(){
		return $this->datosConsulta;
	}
	public function crearT()
    {
        $bd = new mysqli($this->server, $this->username, $this->password, $this->nombrebasedatos);
        if ($bd->connect_error) {
            exit("<p>ERROR de conexión:" . $bd->connect_error . "</p>");
        } 
        $c=$_POST['nombreJuegoo'];
        $remp = $bd->query("SELECT id FROM JUEGO where nombre ='$c'");
        $juego = mysqli_fetch_array($remp)[0];
        $consulta = $bd->prepare("INSERT INTO Tipo (descripcion,id_juego) VALUES (?,?)");
        $consulta->bind_param('ss',
            $_POST["descripcion"],$juego);
        $consulta->execute();
        $consulta->close();
        $bd->close();
    }
	public function crearP()
    {
        $bd = new mysqli($this->server, $this->username, $this->password, $this->nombrebasedatos);
        if ($bd->connect_error) {
            exit("<p>ERROR de conexión:" . $bd->connect_error . "</p>");
        } 
        $c=$_POST['nombreJueg'];
        $remp = $bd->query("SELECT id FROM JUEGO where nombre ='$c'");
        $juego = mysqli_fetch_array($remp)[0];
        $consulta = $bd->prepare("INSERT INTO Publico (publicoObjetivo,publicoReal,id_juego) VALUES (?,?,?)");
        $consulta->bind_param('sss',
            $_POST["publicoO"], $_POST["publicoR"],$juego);
        $consulta->execute();
        $consulta->close();
        $bd->close();
    }
	public function modificarJ(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        }  
        $consulta = $bd->prepare("UPDATE JUEGO SET ".$_POST['columnaJ']." = ? WHERE nombre= ?");
        
		if($_POST['columnaJ']=='trailer' ||$_POST['columnaJ']=='id_creador' ){
        $consulta->bind_param('is', $_POST["mJ"],$_POST['nombreJueg']); 
        }
        else{
            $consulta->bind_param('ss', $_POST["mJ"],$_POST['nombreJueg']); 
        }
        $consulta->execute();
        $consulta->close();
        $bd->close(); 
    }

    public function modificarE(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        $consulta = $bd->prepare("UPDATE EMPRESA SET ".$_POST['columnaE']." = ? WHERE nombre= ?");
        $consulta->bind_param('ss',$_POST['mE'],$_POST['nombreE']); 
        print_r($_POST['mE']);
		print_r($_POST['nombreE']);
		$consulta->execute();
        $consulta->close();
        $bd->close(); 
    }
    public function modificarC(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        $consulta = $bd->prepare("UPDATE CREADOR SET ".$_POST['columnaC']." = ? WHERE nombre= ?");
        $consulta->bind_param('ss',$_POST['mC'],$_POST['nombreC']); 
        $consulta->execute();
        $consulta->close();
        $bd->close(); 
    }
	public function modificarT(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        $consulta = $bd->prepare("UPDATE TIPO SET ".$_POST['columnaT']." = ? WHERE descripcion= ?");
        $consulta->bind_param('ss',$_POST['mT'],$_POST['nombreT']); 
        $consulta->execute();
        $consulta->close();
        $bd->close(); 
    }
	public function BuscarDatosJuego()
    {
		$this->datosConsulta="";
        $bd = new mysqli($this->server, $this->username, $this->password, $this->nombrebasedatos);
        if ($bd->connect_error) {
            exit("<p>ERROR de conexión:" . $bd->connect_error . "</p>");
        } 
        $consulta = $bd->prepare("SELECT * FROM Juego WHERE ".$_POST['columnaJuego']." =?");
		if($_POST['columnaJuego']=='trailer'||$_POST['columnaJuego']=='id_creador'){
			$consulta->bind_param('i', $_POST["buscJ"]); 
        }
		else{
			$consulta->bind_param('s', $_POST["buscJ"]); 
		}
        $consulta->execute();
        $resultado = $consulta->get_result();
		 
        while($fila = $resultado->fetch_assoc()) {
                 $this->datosConsulta.="<p> id = " . $fila["id"] . " nombre = ".$fila['nombre']." saga = ".$fila['saga']." fechaestreno = ".$fila['fechaestreno'].
				 " ".$this->getCreadorById($fila['id_creador']); 
              }               
           
          $consulta->close();
          $bd->close();
		  
	}
    public function getCreadorById($id){
		$bd = new mysqli($this->server, $this->username, $this->password, $this->nombrebasedatos);
        if ($bd->connect_error) {
            exit("<p>ERROR de conexión:" . $bd->connect_error . "</p>");
        } 
        $consulta = $bd->prepare("SELECT nombre FROM CREADOR WHERE id = ?");
        $consulta->bind_param('i',$id); 
        $consulta->execute();
        $resultado = $consulta->get_result();
		while($fila = $resultado->fetch_assoc()) {
                 $this->datosConsulta.="<p>creador = ".$fila['nombre']."</p>"; 
              }               
          $consulta->close();
          $bd->close(); 
	}
	 public function eliminarDatosJ(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        $consultaPre = $bd->prepare("DELETE FROM Juego WHERE nombre = ?");
        $consultaPre->bind_param('s', $_POST["nombreJ"]);    
        $consultaPre->execute();
        $consultaPre->close();
        $bd->close(); 
    }
    public function eliminarDatosC(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        $consultaPre = $bd->prepare("DELETE FROM CREADOR WHERE nombre = ?");
        $consultaPre->bind_param('s', $_POST['nombreC']);    
        $consultaPre->execute();
        $consultaPre->close();
        $bd->close(); 
    }
    public function eliminarDatosE(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        $consultaPre = $bd->prepare("DELETE FROM EMPRESA WHERE nombre = ?");
        $consultaPre->bind_param('s', $_POST['nombreE']);   
        $consultaPre->execute();
        $consultaPre->close();
        $bd->close(); 
    }
	public function eliminarDatosP(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        $consultaPre = $bd->prepare("DELETE FROM PUBLICO WHERE publicoObjetivo = ?");
        $nomrP=str_replace(" ","_",$_POST['publicoO']);
        $consultaPre->bind_param('s', $nomrP);   
        $consultaPre->execute();
        $consultaPre->close();
        $bd->close(); 
    }
	public function eliminarDatosT(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
        $consultaPre = $bd->prepare("DELETE FROM TIPO WHERE descripcion = ?");
		$nomrD=str_replace(" ","_",$_POST['descripcionEli']);
        $consultaPre->bind_param('s', $nomrD);   
        $consultaPre->execute();
        $consultaPre->close();
        $bd->close(); 
    }
	public function crearTablaJ(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
            else {
                 "<p>Conexión establecida con " . $bd->host_info . "</p>";
        }
		$crearT = "CREATE TABLE IF NOT EXISTS JUEGO (id INT NOT NULL AUTO_INCREMENT, 
        nombre VARCHAR(255) NOT NULL, 
        saga VARCHAR(255) NOT NULL,  
        fechaestreno VARCHAR(255) NOT NULL, 
        trailer INT(9) NOT NULL, 
        id_creador INT NOT NULL, 
        PRIMARY KEY (id),
        FOREIGN KEY(id_creador)
			REFERENCES CREADOR(id)
			ON DELETE CASCADE)";
		if($bd->query($crearT) === TRUE){
         "<p>Tabla 'JUEGO' creada con éxito </p>";
        } else { 
        echo "<p>ERROR en la creación de la tabla JUEGO. Error : ". $bd->error . "</p>";
        exit();
        }  
        $bd->close();  
	
	}
	public function crearTablaC(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
            else {
                "<p>Conexión establecida con " . $bd->host_info . "</p>";
        }
		$crearT = "CREATE TABLE IF NOT EXISTS CREADOR (id INT NOT NULL AUTO_INCREMENT, 
        nombre VARCHAR(255) NOT NULL, 
        apellidos VARCHAR(255) NOT NULL,  
        fechaNacimiento VARCHAR(255) NOT NULL, 
        id_empresa INT NOT NULL, 
        PRIMARY KEY (id),
        FOREIGN KEY(id_empresa)
			REFERENCES EMPRESA(id)
			ON DELETE CASCADE)";
		if($bd->query($crearT) === TRUE){
         "<p>Tabla 'CREADOR' creada con éxito </p>";
        } else { 
        echo "<p>ERROR en la creación de la tabla CREADOR. Error : ". $bd->error . "</p>";
        exit();
        }  
        $bd->close();  
	
	}
	public function crearTablaT(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
            else {
                 "<p>Conexión establecida con " . $bd->host_info . "</p>";
        }
		$crearT = "CREATE TABLE IF NOT EXISTS TIPO (id INT NOT NULL AUTO_INCREMENT, 
        descripcion VARCHAR(255) NOT NULL, 
        id_juego INT NOT NULL, 
        PRIMARY KEY (id),
        FOREIGN KEY(id_juego)
			REFERENCES JUEGO(id)
			ON DELETE CASCADE)";
		if($bd->query($crearT) === TRUE){
         "<p>Tabla 'TIPO' creada con éxito </p>";
        } else { 
        echo "<p>ERROR en la creación de la tabla TIPO. Error : ". $bd->error . "</p>";
        exit();
        }  
        $bd->close();  
	
	}
	public function crearTablaP(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
            else {
                "<p>Conexión establecida con " . $bd->host_info . "</p>";
        }
		$crearT = "CREATE TABLE IF NOT EXISTS PUBLICO (id INT NOT NULL AUTO_INCREMENT, 
        publicoObjetivo VARCHAR(255) NOT NULL,
		publicoReal VARCHAR(255) NOT NULL,		
        id_juego INT NOT NULL, 
        PRIMARY KEY (id),
		FOREIGN KEY(id_juego)
			REFERENCES JUEGO(id)
			ON DELETE CASCADE)";
		if($bd->query($crearT) === TRUE){
         "<p>Tabla 'PUBLICO' creada con éxito </p>";
        } else { 
        echo "<p>ERROR en la creación de la tabla PUBLICO. Error : ". $bd->error . "</p>";
        exit();
        }  
        $bd->close();  
	
	}
	public function crearTablaE(){
		$this->nombrebasedatos="basedatos7";
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
        if($bd->connect_error) {
            exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
        } 
            else {
                "<p>Conexión establecida con " . $bd->host_info . "</p>";
        }
		$crearT = "CREATE TABLE IF NOT EXISTS EMPRESA (id INT NOT NULL AUTO_INCREMENT, 
        nombre VARCHAR(255) NOT NULL, 
        inicio VARCHAR(255) NOT NULL,  
        fundador VARCHAR(255) NOT NULL, 
        PRIMARY KEY (id))";
		if($bd->query($crearT) === TRUE){
         "<p>Tabla 'EMPRESA' creada con éxito </p>";
        } else { 
        echo "<p>ERROR en la creación de la tabla EMPRESA. Error : ". $bd->error . "</p>";
        exit();
        }  
        $bd->close();  
	}
    public function importarJ(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $f = fopen("Juego.csv", "r");

    while( ($data = fgetcsv($f, 1000, ";") ) !== FALSE )
    {
    $q = "INSERT INTO JUEGO (id,nombre,saga,fechaestreno,trailer,id_creador) VALUES (
        '$data[0]', 
        '$data[1]',
        '$data[2]',
        '$data[3]',
        '$data[4]',
		'$data[5]'
    )";
    $bd->query($q);
    }
    fclose($f);
    $bd->close();
    }
	 public function importarE(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $f = fopen("Empresa.csv", "r");
    while( ($data = fgetcsv($f, 1000, ";") ) !== FALSE )
    {
			$q = "INSERT INTO EMPRESA (id,nombre,inicio,fundador) VALUES (
			'$data[0]', 
			'$data[1]',
			'$data[2]',
			'$data[3]'
		)";
		$bd->query($q);
	}
	$bd->close();
    fclose($f);
    }
	public function importarC(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $f = fopen("Creador.csv", "r");

    while( ($data = fgetcsv($f, 1000, ";") ) !== FALSE )
    {
    $q = "INSERT INTO CREADOR (id,nombre,apellidos,fechaNacimiento,id_empresa) VALUES (
        '$data[0]', 
        '$data[1]',
        '$data[2]',
        '$data[3]',
		'$data[4]'
    )";
    $bd->query($q);
    }
    fclose($f);
    $bd->close();

    }
	public function importarT(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $f = fopen("Tipo.csv", "r");

    while( ($data = fgetcsv($f, 1000, ";") ) !== FALSE )
    {

    $q = "INSERT INTO TIPO (id,descripcion,id_juego) VALUES (
        '$data[0]', 
        '$data[1]',
		'$data[2]'
    )";
    $bd->query($q);
    }
    fclose($f);
    $bd->close();

    }
	public function importarP(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $f = fopen("Publico.csv", "r");

    while( ($data = fgetcsv($f, 1000, ";") ) !== FALSE )
    {

    $q = "INSERT INTO PUBLICO (id,publicoObjetivo,publicoReal,id_juego) VALUES (
        '$data[0]', 
        '$data[1]',
		'$data[2]',
		'$data[3]'
    )";
    $bd->query($q);
    }
    fclose($f);
    $bd->close();
    }
	public function exportar(){
        $this->exportarJ();
        $this->exportarT();
        $this->exportarC();
		$this->exportarE();
        $this->exportarP();  
    }
	public function exportarJ(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $all=$bd->query("SELECT * FROM  Juego");
    $dato= array();
    if($all->num_rows>0){
        while($row=$all->fetch_assoc()){
           $dato[]=$row;
        }
    }
     $f = fopen("Juego.csv", "w");
     $delimiter=";";
    foreach ($dato as $line) {
         fputcsv($f, $line, $delimiter);
    }
        $bd->close();
    }
	public function exportarE(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $all=$bd->query("SELECT * FROM  EMPRESA");
    $dato= array();
    if($all->num_rows>0){
        while($row=$all->fetch_assoc()){
           $dato[]=$row;
        }
    }
     $f = fopen("Empresa.csv", "w");
     $delimiter=";";
    foreach ($dato as $line) {
         fputcsv($f, $line, $delimiter);
    }
        $bd->close();
    }
	public function exportarC(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $all=$bd->query("SELECT * FROM  Creador");
    $dato= array();
    if($all->num_rows>0){
        while($row=$all->fetch_assoc()){
           $dato[]=$row;
        }
    }
     $f = fopen("Creador.csv", "w");
     $delimiter=";";
    foreach ($dato as $line) {
         fputcsv($f, $line, $delimiter);
    }
        $bd->close();
    }
	public function exportarT(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $all=$bd->query("SELECT * FROM  Tipo");
    $dato= array();
    if($all->num_rows>0){
        while($row=$all->fetch_assoc()){
           $dato[]=$row;
        }
    }
     $f = fopen("Tipo.csv", "w");
     $delimiter=";";
    foreach ($dato as $line) {
         fputcsv($f, $line, $delimiter);
    }
        $bd->close();
    }
	public function exportarP(){
        $bd = new mysqli($this->server,$this->username,$this->password,$this->nombrebasedatos);
    if($bd->connect_error) {
        exit ("<p>ERROR de conexión:".$bd->connect_error."</p>");  
    } 
    $all=$bd->query("SELECT * FROM  Publico");
    $dato= array();
    if($all->num_rows>0){
        while($row=$all->fetch_assoc()){
           $dato[]=$row;
        }
    }
     $f = fopen("Publico.csv", "w");
     $delimiter=";";
    foreach ($dato as $line) {
         fputcsv($f, $line, $delimiter);
    }
        $bd->close();
    }
}
if(count($_POST)>0){
        if(isset($_POST['crear'])){
            $baseDatos->crearBase();
        }
		if (isset($_POST['crearE'])) {
        $baseDatos->crearE();
			}
		if (isset($_POST['crearC'])) {
		$baseDatos->crearC();
			}
		if (isset($_POST['crearJ'])) {
        $baseDatos->crearJ();
		}
		if (isset($_POST['crearP'])) {
		$baseDatos->crearP();
			}
		if (isset($_POST['crearT'])) {
        $baseDatos->crearT();
		}
		if(isset($_POST['juegoE'])){
        $baseDatos-> importarE();
		}
		if(isset($_POST['juegoC'])){
        $baseDatos-> importarC();
		}
		if(isset($_POST['juegoI'])){
        $baseDatos-> importarJ();
    }
		if(isset($_POST['juegoT'])){
        $baseDatos-> importarT();
		}
		if(isset($_POST['juegoP'])){
        $baseDatos-> importarP();
    }
		if(isset($_POST['ExjuegoE'])){
        $baseDatos-> exportarE();
		}
		if(isset($_POST['ExjuegoC'])){
        $baseDatos-> exportarC();
		}
		if(isset($_POST['ExjuegoI'])){
        $baseDatos-> exportarJ();
    }
		if(isset($_POST['ExjuegoT'])){
        $baseDatos-> exportarT();
		}
		if(isset($_POST['ExjuegoP'])){
        $baseDatos-> exportarP();
    }
	 if(isset($_POST['eliminarJ'])){
        $baseDatos-> eliminarDatosJ();
    }
    if(isset($_POST['eliminarE'])){
        $baseDatos-> eliminarDatosE();
    }
    if(isset($_POST['eliminarC'])){
        $baseDatos-> eliminarDatosC();
    }
	if(isset($_POST['eliminarP'])){
        $baseDatos-> eliminarDatosP();
    }
	if(isset($_POST['eliminarT'])){
        $baseDatos-> eliminarDatosT();
    }
	if(isset($_POST['buscarJ'])){
        $baseDatos-> BuscarDatosJuego();
    }
	if(isset($_POST['modificarJ'])){
        $baseDatos-> modificarJ();
    }
	if(isset($_POST['modificarE'])){
        $baseDatos-> modificarE();
    }
	if(isset($_POST['modificarC'])){
        $baseDatos-> modificarC();
    }
	if(isset($_POST['modificarT'])){
        $baseDatos-> modificarT();
    }
	if(isset($_POST['eliminarP'])){
        $baseDatos-> eliminarDatosP();
    }
	if(isset($_POST['eliminarT'])){
        $baseDatos-> eliminarDatosT();
    }
	if(isset($_POST['buscarJ'])){
        $baseDatos-> BuscarDatosJuego();
    }
    }
?>