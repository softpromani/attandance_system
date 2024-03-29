<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>J.S.F. Academy | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/images/collage/JFS.png') }}" style="border-radius: 25%;">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/styles/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/fonts/css/fontawesome-all.min.css')}}">
    {{-- <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js"> --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontend/assets/app/icons/icon-192x192.png')}}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" > --}}
</head>
<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default"> 

        <div id="content" class="card card-style mt-3">
            @include('frontend.includes.header') 
            
            <div class="content mb-0">
                <button type="button" id="backButton" style="float: left; font-weight:900;">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                <div id="map-canvas" style="height: 400px; width: 100%; padding-top:10px;"></div>
                <h4>Updated Coordinates (X,Y)</h4>
                
                    <div id="info" style=" color:red; font-family: Arial; height:200px; font-size: 12px; "></div>
                   
            </div>
          
        </div>
      
{{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMq4WI77B_DyzBDookMHz6s1qKxANWaqs&libraries=drawing&callback=drawing" ></script> --}}
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMq4WI77B_DyzBDookMHz6s1qKxANWaqs&libraries=drawing&callback=InitMap"></script>

 
 <script>
    var mapOptions;
    var map;
    
    var coordinates = []
    let new_coordinates = []
    let lastElement
    
    function InitMap() {
        var location = new google.maps.LatLng(25.7447252,82.6598815)
        mapOptions = {
            zoom: 12,
            center: location,
            mapTypeId: google.maps.MapTypeId.RoadMap
        }
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions)
        var all_overlays = [];
        var selectedShape;
        var drawingManager = new google.maps.drawing.DrawingManager({
            //drawingMode: google.maps.drawing.OverlayType.MARKER,
            //drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [
                    //google.maps.drawing.OverlayType.MARKER,
                    //google.maps.drawing.OverlayType.CIRCLE,
                    google.maps.drawing.OverlayType.POLYGON,
                    //google.maps.drawing.OverlayType.RECTANGLE
                ]
            },
            markerOptions: {
                //icon: 'images/beachflag.png'
            },
            circleOptions: {
                fillColor: '#ffff00',
                fillOpacity: 0.2,
                strokeWeight: 3,
                clickable: false,
                editable: true,
                zIndex: 1
            },
            polygonOptions: {
                clickable: true,
                draggable: false,
                editable: true,
                // fillColor: '#ffff00',
                fillColor: '#ADFF2F',
                fillOpacity: 0.5,
    
            },
            rectangleOptions: {
                clickable: true,
                draggable: true,
                editable: true,
                fillColor: '#ffff00',
                fillOpacity: 0.5,
            }
        });
    
        function clearSelection() {
            if (selectedShape) {
                selectedShape.setEditable(false);
                selectedShape = null;
            }
        }
        //to disable drawing tools
        function stopDrawing() {
            drawingManager.setMap(null);
        }
    
        function setSelection(shape) {
            clearSelection();
            stopDrawing()
            selectedShape = shape;
            shape.setEditable(true);
        }
    
        function deleteSelectedShape() {
            if (selectedShape) {
                selectedShape.setMap(null);
                drawingManager.setMap(map);
                coordinates.splice(0, coordinates.length)
                document.getElementById('info').innerHTML = ""
            }
        }
    
        function CenterControl(controlDiv, map) {
    
            // Set CSS for the control border.
            var controlUI = document.createElement('div');
            controlUI.style.backgroundColor = '#fff';
            controlUI.style.border = '2px solid #fff';
            controlUI.style.borderRadius = '3px';
            controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
            controlUI.style.cursor = 'pointer';
            controlUI.style.marginBottom = '22px';
            controlUI.style.textAlign = 'center';
            controlUI.title = 'Select to delete the shape';
            controlDiv.appendChild(controlUI);
    
            // Set CSS for the control interior.
            var controlText = document.createElement('div');
            controlText.style.color = 'rgb(25,25,25)';
            controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
            controlText.style.fontSize = '12px';
            controlText.style.lineHeight = '38px';
            controlText.style.paddingLeft = '5px';
            controlText.style.paddingRight = '5px';
            controlText.innerHTML = 'Delete';
            controlUI.appendChild(controlText);
    
            //to delete the polygon
            controlUI.addEventListener('click', function () {
                deleteSelectedShape();
            });
           
        }
       
        drawingManager.setMap(map);
        var getPolygonCoords = function (newShape) {
            coordinates.splice(0, coordinates.length)
            var len = newShape.getPath().getLength();
    
            for (var i = 0; i < len; i++) {
                coordinates.push(newShape.getPath().getAt(i).toUrlValue(6))
            }
            document.getElementById('info').innerHTML = coordinates
           
        }
    
        google.maps.event.addListener(drawingManager, 'polygoncomplete', function (event) {
            event.getPath().getLength();
            google.maps.event.addListener(event, "dragend", getPolygonCoords(event));
    
            google.maps.event.addListener(event.getPath(), 'insert_at', function () {
                getPolygonCoords(event)
                
            });
    
            google.maps.event.addListener(event.getPath(), 'set_at', function () {
                getPolygonCoords(event)
            })
        })
    
        google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
            all_overlays.push(event);
            if (event.type !== google.maps.drawing.OverlayType.MARKER) {
                drawingManager.setDrawingMode(null);
    
                var newShape = event.overlay;
                newShape.type = event.type;
                google.maps.event.addListener(newShape, 'click', function () {
                    setSelection(newShape);
                });
                setSelection(newShape);
            }
        })
        var centerControlDiv = document.createElement('div');
        var centerControl = new CenterControl(centerControlDiv, map);
        centerControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(centerControlDiv);
    
    }
    document.getElementById('backButton').addEventListener('click', function() {
                window.history.back();
            });

    InitMap()
    </script>
  
        </body>
       </html> 