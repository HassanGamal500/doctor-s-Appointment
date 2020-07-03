// Import and configure the Firebase SDK
// These scripts are made available when the app is served or deployed on Firebase Hosting
// If you do not serve/host your project using Firebase Hosting see https://firebase.google.com/docs/web/setup
importScripts('https://www.gstatic.com/firebasejs/7.6.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.6.0/firebase-messaging.js');
// importScripts('https://www.gstatic.com/firebasejs/init.js');

firebase.initializeApp({
    apiKey: "AIzaSyDjxAxn0mYcD5LfILLoTr3yzlaOszzAz64",
    authDomain: "caduceus-lane.firebaseapp.com",
    databaseURL: "https://caduceus-lane.firebaseio.com",
    projectId: "caduceus-lane",
    storageBucket: "caduceus-lane.appspot.com",
    messagingSenderId: "330869143074",
    appId: "1:330869143074:web:801e7a4da09df29109fc7b",
    measurementId: "G-XCX9ST0BMP"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    var title =payload.data.title;
  
    var options ={
            body: payload.data.body,
            icon: payload.data.icon,
            image: payload.data.image,
            data:{
                    time: new Date(Date.now()).toString(),
                    click_action: payload.data.click_action
                }
      
    };
    return self.registration.showNotification(title, options);
  
});


self.addEventListener('notificationclick', function(event) {

    var action_click=event.notification.data.click_action;
    event.notification.close();
    
    event.waitUntil(
        clients.openWindow(action_click)
    );
});