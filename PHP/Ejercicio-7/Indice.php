
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
<h2>Crear Base De datos</h2>
<p>Crear nueva BD</p>
<input type='submit' name='crear' value= 'Crear BD'/>
</form>
</body>
</html>";
?>