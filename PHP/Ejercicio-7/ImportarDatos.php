
<?php include 'Ejercicio7.php';
echo"
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'/>
    <title>Base de Datos</title>
    <link rel='stylesheet' href='Ejercicio7.css'/>
    <meta name='viewport' content='width=device-width, innital-scale=1'/>
    
</head>
<body>
<header>
<h1>Base de Datos</h1>   
</header>
<nav >
    <a href='Indice.php' accesskey='i'>Inicio</a>
    <a href='InsertarDatos.php' accesskey='d'>Insertar Datos</a>
    <a href='ModificarDatos.php' accesskey='m'>Modificar Datos</a>
    <a href='BuscarDatos.php' accesskey='b'>Buscar Datos De un Juego</a>
    <a href='EliminarDatos.php' accesskey='e'>Eliminar Datos</a>
    <a href='ExportarDatos.php' accesskey='x'>Exportar Datos</a>
    <a href='ImportarDatos.php' accesskey='r'>Importar Datos</a>
</nav>
<form action='#' method='post' name='Ejercicio7.php'>
    
<h2>Importacion de los datos de la tabla</h2>
<p>Importar tabla del Empresa debe llamarse el csv Empresa</p>
<input type='submit' name='juegoE' value= 'Importar Empresa'/>
<p>Importar tabla del Creador debe llamarse el csv Creador</p>
<input type='submit' name='juegoC' value= 'Importar Creador'/>
<p>Importar tabla del juego debe llamarse el csv Juego</p>
<input type='submit' name='juegoI' value= 'Importar Juego'/>
<p>Importar tabla del Tipo debe llamarse el csv Tipo</p>
<input type='submit' name='juegoT' value= 'Importar Tipo'/>
<p>Importar tabla del Público debe llamarse el csv Publico</p>
<input type='submit' name='juegoP' value= 'Importar Publico'/>
</form>
</body>
</html>";
?>