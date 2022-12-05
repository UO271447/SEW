var parrafo = true;
var h3 = true;

$(document).ready(function(){
   $('input[type=button]:nth-child(3)').click(function () {
        var texto = $('input[type=text]').val();
        $('h1').text(texto);
    });

    $('input[type=button]:nth-child(4)').click(function () {
        if (parrafo)
            $('p').hide();

        else
            $('p').show();
        parrafo = !parrafo;
    });
	
	$('input[type=button]:nth-child(5)').click(function () {
        if (h3)
            $('h3').hide();

        else
            $('h3').show();
        h3 = !h3;
    });
	$('input[type=button]:nth-child(6)').click(function () {
         $('p').after('<p>Parrafo after</p>');
    });
	$('input[type=button]:nth-child(7)').click(function () {
         $('h3').before('<h3>h3 Before</h3>');
    });
	$('input[type=button]:nth-child(8)').click(function () {
         $('p').append('parrafo con append');
    });
	$('input[type=button]:nth-child(9)').click(function () {
         $('p').prepend('parrafo con prepend');
    });

    $('input[type=button]:nth-child(10)').click(function () {
        $('p').remove();
    });
	$('input[type=button]:nth-child(11)').click(function () {
        var padre;
        var hijo;
        $("*", document.body).each(function () {
            padre = $(this).parent().get(0).tagName;
            hijo = $(this).get(0).tagName;
            $('table').after("<p>Elemento: " + hijo + ", etiqueta del padre: " + padre + ". </p>");
        });
	});
	 $('input[type=button]:last-child()').click(function () {
        const filas=document.querySelectorAll("table tbody tr");
  filas.forEach((fila) => {
   const tds=fila.querySelectorAll("td");
   let total=0;
   for(let i=1; i<tds.length-1; i++) {
       total+=parseFloat(tds[i].innerHTML);
   }
   tds[tds.length-1].innerHTML=total.toFixed(2);
		});
		const columnas=document.querySelectorAll("table thead tr th");

		const totalFila=document.querySelectorAll("table tfoot tr td");

	for(let i=1; i<columnas.length; i++) {
		let total=0;
		filas.forEach((fila) => {
		total+=parseFloat(fila.querySelectorAll("td")[i].innerHTML);
	});
	totalFila[i].innerHTML=total.toFixed(2);
  }
    });
 });