
class Funciones{
constructor(){}
ocultar (str) {
  $(str).hide();
}

mostrar (str) {
  $(str).show();
}

cambiarh1 (str) {
  $('h1').text(document.getElementsByTagName('input')[0].value);
}
cambiarp1 (str) {
  $('p:first').text(document.getElementsByTagName('input')[2].value);
}
anadirAppend (str) {
  $(str).append(' Acabo de añadir este texto con Append. ');
}

anadirPrepend (str) {
  $(str).prepend(' Acabo de añadir este texto con Prepend. ');
}
anadirBefore (str) {
  $(str).before('<'+ str+'>'+' Acabo de añadir este texto con Before. '+'</'+ str+'>');
}
anadirAfter (str) {
  $(str).after('<'+ str+'>'+' Acabo de añadir este texto con After. '+'</'+ str+'>');
}
eliminar(str) {
  $(str).remove();
}
recorrerTodosLosElementos () {
  $('*', document.body).each(function () {
    var etiquetaPadre = $(this).parent().get(0).tagName;
    $(this).prepend(document.createTextNode('Etiqueta padre : <' + etiquetaPadre + '> elemento : <' + $(this).get(0).tagName + '> valor: '));
  })
}
sumarFilasCol(){
  const filas=document.querySelectorAll('table tbody tr');
  filas.forEach((fila) => {
   const filatd=fila.querySelectorAll('td');
   var total=0;
   for(var i=1; i<filatd.length-1; i++) {
       total+=parseFloat(filatd[i].innerHTML);
   }
   filatd[filatd.length-1].innerHTML=total.toFixed(2);
});
const columnas=document.querySelectorAll('table thead tr th');

const filassum=document.querySelectorAll('table tfoot tr td');

for(var i=1; i<columnas.length; i++) {
   var total=0;
   filas.forEach((fila) => {
       total+=parseFloat(fila.querySelectorAll('td')[i].innerHTML);
   });
   filassum[i].innerHTML=total.toFixed(2);
  }
 }



}
var funcion= new Funciones();
