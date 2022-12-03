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
    var lect = new FileReader();
    lect.onload = function (evento) {
      var map = new google.maps.Map(document.getElementsByTagName('main')[0], {
        center: new google.maps.LatLng(40.4165, -3.70256),
        zoom: 5,
        mapTypeId: 'terrain'
      });
      var domparser = new DOMParser();
      var xml = domparser.parseFromString(lect.result, "text/xml");
      var kml = xml.getElementsByTagName("kml")[0].getElementsByTagName("Document")[0];
      var placemark = kml.getElementsByTagName("Placemark");
      for (var i = 0; i < placemark.length; i++) {
        var name = kml.getElementsByTagName("name")[0];
        var point = name.getElementsByTagName("Point")[0];
        var coordinates = xml.getElementsByTagName("coordinates")[i].textContent;
        var c = coordinates.split("  "); 
        var coordinatess = []
    
        c.forEach(function (coordenates) {
     
          var valores = coordenates.split(",");
          var marker = new google.maps.Marker({
            position: {
              lat: parseFloat(valores[1]),
              lng: parseFloat(valores[0])
            },
            map: map
          });
          coordinatess.push({ lat: parseFloat(valores[1]), lng: parseFloat(valores[0]) });
        });   
	  }

    }
    lect.readAsText(archivo);
  }


}
var archivo = new Archivo();

