importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyAwDQm7M6h2Jm30yZ2VzyI1uPgW3ZeLfrI",
    authDomain: "e-yajamana.firebaseapp.com",
    projectId: "e-yajamana",
    storageBucket: "e-yajamana.appspot.com",
    messagingSenderId: "521034262423",
    appId: "1:521034262423:web:6c9e5f7fdc80bf77a846d2",
    measurementId: "G-93GDMX9QYD"
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
