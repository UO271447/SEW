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
<h1>Insertar</h1>   
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
    <h2>Insertar datos</h2>
    <p>
    <label for='dni'>DNI</label>
    <input type='text' id='dni' name='dni' value=''/>
    </p>
    <p>
    <label for='nombre'>Nombre Persona</label>
    <input type='text' id='nombre' name='nombre' value=''/>
    </p>
    <p>
    <label for='apellidos'>Apellido persona</label>
    <input type='text' id='apellidos' name='apellidos' value=''/>
    </p>
    <p>
    <label for='email'>Email persona</label>
    <input type='text' id='email' name='email' value=''/>
    </p>
    <p>
    <label for='telefono'>Telefono persona</label>
    <input type='text' id='telefono' name='telefono' value=''/>
    </p>
    <p>
    <label for='edad'>Edad persona</label>
    <input type='text' id='edad' name='edad' value=''/>
    </p>
	<fieldset>
    <legend>Selecciona tu sexo :</legend>
    <input type='radio' id='masc' name='sex' value='Masculino' checked />
	<label for='masc'>Masculino</label>
	<input type='radio' id='feme' name='sex' value='Femenino'/>
	<label for='feme'>Femenino</label>
	<input type='radio' id='other' name='sex' value='Otros'/>
	<label for='other'>Otros</label>
    </fieldset>
    <p>
    <label for='pericia'>Pericia informatica</label>
    <input type='text' id='pericia' name='pericia' value=''/>
    </p>
    <p>
    <label for='tiempo'>Tiempo en hacer la tarea en segundos</label>
    <input type='text' id='tiempo' name='tiempo' value=''/>
    </p>
    <fieldset>
    <legend>Realizada tarea correctamente si/no :</legend>
    <input type='radio' id='si' name='correct' value='si' checked />
	<label for='si'>Si</label>
	<input type='radio' id='no' name='correct' value='no'/>
	<label for='no'>No</label>
    </fieldset>
    <p>
    <label for='comentarios'>Comentarios sobre problemas encontrados usando la aplicación</label>
    <input type='text' id='comentarios' name='comentarios' value=''/>
    </p>
    <p>
    <label for='propuestas'>Propuestas de mejora de la aplicación</label>
    <input type='text' id='propuestas' name='propuestas' value=''/>
    </p>
    <p>
    <label for='valoracion'>Valoración de la aplicacion por parte del usuario del 0 al 10</label>
    <input type='text' id='valoracion' name='valoracion' value=''/>
    </p>
    <input type='submit' name='crearD' value= 'Insertar'/>
	</form>
</body>
</html>";?>