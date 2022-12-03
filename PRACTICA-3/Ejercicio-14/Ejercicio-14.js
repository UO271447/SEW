class Archivo {
  constructor() {
    document.addEventListener("keydown", function (f) {
      if (f.keyCode == 13) {
        if (!document.fullscreenElement) {
          document.documentElement.requestFullscreen();
        }
        else {
          if (document.exitFullscreen) {
            document.exitFullscreen();
          }
        }
      }
    }, false)
  }
	canvas() {

         var txt= document.getElementsByTagName('input')[1].value;
         var canvas = document.getElementsByTagName('canvas')[0];
         var contenido = canvas.getContext("2d");
         contenido.strokeText(txt,100,100);  
  }
  borrarCanvas() {
         var canvas = document.getElementsByTagName('canvas')[0];
         var contenido = canvas.getContext("2d");
         contenido.clearRect(0, 0, canvas.width, canvas.height);
  }
  cargar() {
    var first = document.getElementsByTagName('img')[0];
    var arch = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();

    reader.onload = function () {
      first.src = reader.result;
    }

    if (arch) {
      reader.readAsDataURL(arch);
    } else {
      first.src = "";
    }

  }

    
  }

var archivo = new Archivo();

