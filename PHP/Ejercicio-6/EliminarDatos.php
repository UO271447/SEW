<?php include 'Ejercicio6.php';
echo"
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'/>
    <title>Base de Datos</title>
    <link rel='stylesheet' href='Ejercicio6.css'/>

</head>
<body>
<header>
<h1>Eliminar</h1>   
</header>
<nav >
        <a href='Indice.php' accesskey='i'>Inicio</a>
        <a href='InsertarDatos.php' accesskey='d'>Insertar Datos a la Tabla</a>   
        <a href='BuscarDatos.php' accesskey='b'>Buscar Datos</a>
        <a href='ModificarDatos.php' accesskey='m'>Modificar Datos</a>
        <a href='EliminarDatos.php' accesskey='e'>Eliminar Datos</a>
        <a href='ExportarDatos.php' accesskey='x'>Exportar Datos</a>
        <a href='ImportarDatos.php' accesskey='r'>Importar Datos</a>
        <a href='GenerarInforme.php' accesskey='g'>Generar Informe</a>
</nav>
    <form action='#' method='post' name='Ejercicio6.php'>
    <h2>Eliminar Datos de la Tabla</h2>
    <p>Eliminar segun DNI</p>
	<label for = 'dnie'>Dni:</label>
	<input type='text' id='dnie' name='dnie' value=''/>
	<input type='submit' name='eliminarDni' value= 'Eliminar Datos'/>
	</form>
</body>
</html>";?>