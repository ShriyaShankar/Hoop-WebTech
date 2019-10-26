// Code to get Firebase started

var app_fireBase = {};
(function()
 {
  // Initialize Firebase
	var config = {
        apiKey: " AIzaSyA-0QCwUKtGsJGxkXhYhbNR5IFTmxIrAko ",
        authDomain: "sportsforum-ceb73.firebaseapp.com",
        databaseURL: "https://sportsforum-ceb73.firebaseio.com",
        projectId: "sportsforum-ceb73",
        storageBucket: "sportsforum-ceb73.appspot.com",
       // messagingSenderId: "609277700050"
     };
  firebase.initializeApp(config);
  app_fireBase = firebase;

})()