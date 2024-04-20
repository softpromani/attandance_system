{/* <script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyCMq4WI77B_DyzBDookMHz6s1qKxANWaqs",
    authDomain: "attendance-417410.firebaseapp.com",
    projectId: "attendance-417410",
    storageBucket: "attendance-417410.appspot.com",
    messagingSenderId: "412414167773",
    appId: "1:412414167773:web:8b32778f5c41afef7ee934",
    measurementId: "G-H8V5EVEZZ8"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script> */}

importScripts('https://www.gstatic.com/firebasejs/4.11.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/4.11.0/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyCMq4WI77B_DyzBDookMHz6s1qKxANWaqs",
    authDomain: "attendance-417410.firebaseapp.com",
    projectId: "attendance-417410",
    storageBucket: "attendance-417410.appspot.com",
    messagingSenderId: "412414167773",
    appId: "1:412414167773:web:8b32778f5c41afef7ee934",
    measurementId: "G-H8V5EVEZZ8"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log(
    "[firebase-messaging-sw.js] Received background message ",
    payload,
  );
  /* Customize notification here */
  const notificationTitle = "Background Message Title";
  const notificationOptions = {
    body: "Background Message body.",
    icon: "/itwonders-web-logo.png",
  };

  return self.registration.showNotification(
    notificationTitle,
    notificationOptions,
  );
});
