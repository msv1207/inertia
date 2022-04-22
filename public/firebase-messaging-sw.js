/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyA2t8wf8-wUmlSF7acgDpoeupB71nuhJfU",
    authDomain: "laravel-6ac8c.firebaseapp.com",
    databaseURL: "https://laravel-6ac8c-default-rtdb.europe-west1.firebasedatabase.app",
    projectId: "laravel-6ac8c",
    storageBucket: "laravel-6ac8c.appspot.com",
    messagingSenderId: "814380693226",
    appId: "1:814380693226:web:f8130643ace114df98c993",
    measurementId: "G-VDQDMEEYJ2"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
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
