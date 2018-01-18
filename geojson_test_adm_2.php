<!DOCTYPE html>
<html>
  <head>
    <title>PSI | MAPEAMENTO</title>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.4/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.6.4/build/ol.js"></script>
    
       <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   


    <style type="text/css">


        #map{
          background: rgba(105, 168, 165, 0.59);

        }
        #popup{
          background: #fff;
          padding: 10px;
    border-radius: 8px;



        }

/*******************************/
       .panel {
  position:relative;
}
.panel>.panel-heading:after,.panel>.panel-heading:before{
  position:absolute;
  top:11px;left:-16px;
  right:100%;
  width:0;
  height:0;
  display:block;
  content:" ";
  border-color:transparent;
  border-style:solid solid outset;
  pointer-events:none;
}
.panel>.panel-heading:after{
  border-width:7px;
  border-right-color:#f7f7f7;
  margin-top:1px;
  margin-left:2px;
}
.panel>.panel-heading:before{
  border-right-color:#ddd;
  border-width:8px;
}

      </style>

  </head>
  <body>

  <div>
    <div>
    <h3 id="titulo">MAPEAMENTO  <span><a href="#" id="#">Mozambique</a></span></h3>
    <div id="map" class="map"></div> 

    <div >

        <?php include ('menu.php')?>

    <div class="col-sm-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Country: </strong> <span class="text-muted">Mozambique</span>
            </div>
            <div class="panel-body">
                <div id="info">&nbsp;</div>
            </div><!-- /panel-body -->
        </div><!-- /panel panel-default -->
    </div><!-- /col-sm-5 -->


        <!--inicio do popup-->
    <div id="popup" class="ol-popup animate col-sm-10">

      <a href="#" id="popup-closer" class="ol-popup-closer"></a>
      <div id="popup-content" ></div>



    </div>
    <!--fim do popup-->
    </div>
  </div>

    <script src="js/jquery-3.2.0.min.js"></script>

    <script>
            /**
       * Elements that make up the popup.
       */
      var container = document.getElementById('popup');
      var content = document.getElementById('popup-content');
      var closer = document.getElementById('popup-closer');


      /**
       * Create an overlay to anchor the popup to the map.
       */
      var overlay = new ol.Overlay(/** @type {olx.OverlayOptions} */ ({
        element: container,
        autoPan: true,
        autoPanAnimation: {
        duration: 250
        }
      }));


      /**
       * Add a click handler to hide the popup.
       * @return {boolean} Don't follow the href.
       */
      closer.onclick = function() {
        overlay.setPosition(undefined);
        closer.blur();
        return false;
      };





      var style = new ol.style.Style({
        fill: new ol.style.Fill({
          color: 'rgba(255, 255, 255, 0.6)'
        }),
        stroke: new ol.style.Stroke({
          color: '#319FD3',
          width: 1
        }),
        text: new ol.style.Text({
          font: '12px Calibri,sans-serif',
          fill: new ol.style.Fill({
            color: '#000'
          }),
          stroke: new ol.style.Stroke({
            color: '#fff',
            width: 3
          })
        })
      });

      //difinindo o geojson
      var vectorLayer = new ol.layer.Vector({
        source: new ol.source.Vector({
          url: 'moz_adm_geo_adm2.geojson',
          format: new ol.format.GeoJSON()
        }),
        style: function(feature) {
          style.getText().setText(feature.get('NAME_2'));
          return style;
        }
      });

      var map = new ol.Map({

        layers: [vectorLayer],
        overlays: [overlay],
        target: 'map',
        view: new ol.View({
        /*  center: [-15.099129,39.424425],
          zoom: 4*/

    center: ol.proj.fromLonLat([30.8, -18.5]),
      zoom: 5.7,
      maxZoom:18,
      miZoom:2

        }),
            controls: ol.control.defaults().extend([
              new ol.control.FullScreen(),
              new ol.control.ScaleLine(),
              new ol.control.ZoomSlider(),
              new ol.control.ZoomToExtent(),


          ]),
            });



      var highlightStyle = new ol.style.Style({
        stroke: new ol.style.Stroke({
          color: '#f00',
          width: 1
        }),
        fill: new ol.style.Fill({
          color: 'rgba(255,0,0,0.1)'
        }),
        text: new ol.style.Text({
          font: '12px Calibri,sans-serif',
          fill: new ol.style.Fill({
            color: '#000'
          }),
          stroke: new ol.style.Stroke({
            color: '#f00',
            width: 3
          })
        })
      });

      var featureOverlay = new ol.layer.Vector({
        source: new ol.source.Vector(),
        map: map,
        style: function(feature) {
          highlightStyle.getText().setText(feature.get('NAME_2'));
          return highlightStyle;
        }
      });

      var highlight;
      var displayFeatureInfo = function(pixel) {

        var feature = map.forEachFeatureAtPixel(pixel, function(feature) {
          return feature;
        });

        var info = document.getElementById('info');
        if (feature) {
          info.innerHTML = feature.get('NAME_1') + ': ' + feature.get('NAME_2');
        } else {
          info.innerHTML = '&nbsp;';
        }

        if (feature !== highlight) {
          if (highlight) {
            featureOverlay.getSource().removeFeature(highlight);
          }
          if (feature) {
            featureOverlay.getSource().addFeature(feature);
          }
          highlight = feature;
        }

      };

      map.on('pointermove', function(evt) {
        
        var pixel = map.getEventPixel(evt.originalEvent);
        displayFeatureInfo(pixel);



//alert(pixel);
        var coordinate = evt.coordinate;
        var hdms = ol.coordinate.toStringHDMS(ol.proj.transform(
            coordinate, 'EPSG:3857', 'EPSG:4326'));

       
        //trazendo informacao da camada no cliqui

        //fim da captura da informacao
          var feature = map.forEachFeatureAtPixel(pixel, function(feature) {
          return feature;
        });

       // var pixel = map.getEventPixel(evt.originalEvent);
try {
        content.innerHTML = '<b>'+feature.get('NAME_1') + ' / ' + feature.get('NAME_2')+'</b> <code>' + hdms +
            '</code> <hr> Parceiro | Público | Privado <br> PSI | 350 | 23 <br> MISAU | 29 |13 ';

        overlay.setPosition(coordinate);

        console.log(evt);

    $('#popup').removeClass('hidden');

  }catch (e){
    $('#popup').removeClass('hidden');
    $('#popup').addClass('hidden');
    //alert('ok');

}
      });

      map.on('click', function(evt) {
        displayFeatureInfo(evt.pixel);
        });




    </script>
  </body>
</html>