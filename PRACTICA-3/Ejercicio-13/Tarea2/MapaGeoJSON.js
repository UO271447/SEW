class Archivo {
  constructor() { }

  cargar(files) {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
      var archivos = files;
      this.read(archivos[0]);
    }
    else {
      document.write("<p>Este archivo no soporta el API File y este programa puede no funcionar correctamente")
    }
  }



  read(archivo) {
		var map = new google.maps.Map(document.getElementsByTagName('main')[0], {
              center: new google.maps.LatLng(43.257753, -5.823688),
              zoom: 8,
              mapTypeId: 'satellite'
          });
		if(archivo.name.endsWith(".GeoJSON")){
            var lect=new FileReader();
            lect.readAsText(archivo);
            lect.onload = function (evento) {
              var json = JSON.parse(lect.result);
              map.data.addGeoJson(json);
			}
        }
    }
    
  }

var archivo = new Archivo();

