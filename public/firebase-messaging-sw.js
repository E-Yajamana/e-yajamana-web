importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyAi5-GWTruT_bF15xnbUAGR9c5afq5P_as",
    authDomain: "eyajamana-website.firebaseapp.com",
    // databaseURL: 'https://project-id.firebaseio.com',
    projectId: "eyajamana-website",
    storageBucket: "eyajamana-website.appspot.com",
    messagingSenderId: "980955733639",
    appId: "1:980955733639:web:65b9823c8ff9ff0e0e2222",
    measurementId: "G-XCMZ3MKTZJ"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = 'Notification Baru Masuk';
    const options = {
        body: "Terdapat notification pada apps web-eyajamana",
        icon: "/logo-eyajamana.png",
    };

    return self.registration.showNotification(
        title,
        options,
    );
});
