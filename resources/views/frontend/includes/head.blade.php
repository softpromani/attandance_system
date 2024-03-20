    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>J.S.F. Academy | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/images/collage/coll_logo.png') }}" style="border-radius: 25%;">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/styles/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/fonts/css/fontawesome-all.min.css')}}">
    {{-- <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js"> --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontend/assets/app/icons/icon-192x192.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <style>
      ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.notification-drop {
  font-family: 'Ubuntu', sans-serif;
  color: #444;
}
.notification-drop .item {
  padding: 10px;
  font-size: 18px;
  position: relative;
  border-bottom: 1px solid #ddd;
}
.notification-drop .item:hover {
  cursor: pointer;
}
.notification-drop .item i {
  margin-left: 10px;
}
.notification-drop .item ul {
  display: none;
  position: absolute;
  top: 100%;
  background: #fff;
  left: -200px;
  right: 0;
  z-index: 1;
  border-top: 1px solid #ddd;
}
.notification-drop .item ul li {
  font-size: 16px;
  padding: 15px 0 15px 25px;
}
.notification-drop .item ul li:hover {
  background: #ddd;
  color: rgba(0, 0, 0, 0.8);
}

@media screen and (min-width: 500px) {
  .notification-drop {
    display: flex;
    justify-content: flex-end;
  }
  .notification-drop .item {
    border: none;
  }
}



.notification-bell{
  font-size: 20px;
}

.btn__badge {
  background: #FF5D5D;
  color: white;
  font-size: 12px;
  position: absolute;
  top: 0;
  right: 0px;
  padding:  3px 10px;
  border-radius: 50%;
}

.pulse-button {
  box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.5);
  -webkit-animation: pulse 1.5s infinite;
}

.pulse-button:hover {
  -webkit-animation: none;
}

@-webkit-keyframes pulse {
  0% {
    -moz-transform: scale(0.9);
    -ms-transform: scale(0.9);
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
  70% {
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
    box-shadow: 0 0 0 50px rgba(255, 0, 0, 0);
  }
  100% {
    -moz-transform: scale(0.9);
    -ms-transform: scale(0.9);
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
    box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
  }
}

.notification-text{
  font-size: 14px;
  font-weight: bold;
}

.notification-text span{
  float: right;
}
    </style>
