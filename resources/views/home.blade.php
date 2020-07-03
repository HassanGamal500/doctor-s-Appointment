<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assetForm/css/custom.css">
    <title>@yield('title')</title>
</head>
<body>
    <audio id="mysound" src="{{asset('sound/not-bad.mp3')}}"></audio>
    <nav class="navbar navbar-expand-lg navbar-icon-top navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('order') }}">Appointement's Doctor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item {{request()->is('order') ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('order') }}">Book <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{request()->is('appointment') ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('appointmentStatus') }}">Appointments</a>
                </li>
                <li class="nav-item dropdown {{request()->is('profile') ? 'active' : ''}}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.6.0/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-app.js"></script>
    <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
    <script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-analytics.js"></script>
    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-messaging.js"></script>
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Update Profile 
        $("form#updateProfile").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('updateProfile') }}",
                type: 'POST',
                data: formData,
                success: function (data) {
                    if(data['status'] == 0) {
                        swal("ERROR!", data['message'], "error");
                    } else {
                        $('.passwordEmpty').val('');
                        swal("Good job!", "Updated Successfully!", "success");
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        //Make Order 
        $("form#makeOrder").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('makeOrder') }}",
                type: 'POST',
                data: formData,
                success: function (data) {
                    if(data['status'] == 0) {
                        swal("ERROR!", data['message'], "error");
                    } else {
                        $('.passwordEmpty').val('');
                        swal("Good job!", "Booked Successfully!", "success");
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        //Alert Status
        $(document).on('click', '.alertStatus', function(e){
            var status = $(this).data("status");
            var id = $(this).data("id");
            e.preventDefault();
            swal({
                title: "Are You Sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willUpdate) => {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('changeStatus') }}",
                    data: {appointment_id: id, status_id: status},
                    success:function(data){
                        if (status == 2) {
                            $('#'+id).html("<button type='button' class='btn btn-success disabled'>Accept</button>");
                        } else {
                            $('#'+id).html("<button type='button' class='btn btn-danger disabled'>Reject</button>");
                        }
                        swal("Good job!", "Successfully!", "success");
                    }
                });
               
            });
        });

        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyDjxAxn0mYcD5LfILLoTr3yzlaOszzAz64",
            authDomain: "caduceus-lane.firebaseapp.com",
            databaseURL: "https://caduceus-lane.firebaseio.com",
            projectId: "caduceus-lane",
            storageBucket: "caduceus-lane.appspot.com",
            messagingSenderId: "330869143074",
            appId: "1:330869143074:web:801e7a4da09df29109fc7b"
        };
        
        firebase.initializeApp(firebaseConfig);
        
        if(firebase.messaging.isSupported()) {
            const messaging = firebase.messaging();

            // Add the public key generated from the console here.
            messaging.usePublicVapidKey("BCKVyPm4tGyzrCeq5Y-vlGI94FN3Zb9DEIP_WYQ8_i6mU3JAYBxfOXGCtW60B7bnx9vdHj0n1fm8LPzP60uOAyI");
            Notification.requestPermission().then((permission) => {
                if (permission === 'granted') {
                    console.log('Notification permission granted.');
                    // TODO(developer): Retrieve an Instance ID token for use with FCM.
                    getRegisterToken();
                    // ...
                } else {
                    console.log('Unable to get permission to notify.');
                }
            });
            
            function getRegisterToken() {
                // Get Instance ID token. Initially this makes a network call, once retrieved
                // subsequent calls to getToken will return from cache.
                messaging.getToken().then((currentToken) => {
                    if (currentToken) {
                        saveToken(currentToken);
                        console.log(currentToken);
                        sendTokenToServer(currentToken);
                        // updateUIForPushEnabled(currentToken);
                    } else {
                        // Show permission request.
                        console.log('No Instance ID token available. Request permission to generate one.');
                        // Show permission UI.
                        // updateUIForPushPermissionRequired();
                        setTokenSentToServer(false);
                    }
                }).catch((err) => {
                    console.log('An error occurred while retrieving token. ', err);
                    // showToken('Error retrieving Instance ID token. ', err);
                    setTokenSentToServer(false);
                });
            }
            
            // Send the Instance ID token your application server, so that it can:
            // - send messages back to this app
            // - subscribe/unsubscribe the token from topics
            function sendTokenToServer(currentToken) {
                if (!isTokenSentToServer()) {
                    console.log('Sending token to server...');
                    // TODO(developer): Send the current token to your server.
                    setTokenSentToServer(true);
                } else {
                    console.log('Token already sent to server so won\'t send it again ' + 'unless it changes');
                }
            }
            
            function isTokenSentToServer() {
                return window.localStorage.getItem('sentToServer') === '1';
            }
            
            function setTokenSentToServer(sent) {
                window.localStorage.setItem('sentToServer', sent ? '1' : '0');
            }
            
            function saveToken(currentToken){
                $.ajax({
                    data: {"token":currentToken},
                    type: "POST",
                    url: '{{route('getTokenWeb')}}',
                    headers: {
                        Accept: 'application/json'
                    },
                    success: function(result){
                        console.log(result);
                    }
                });
            }

            function sweet(type){
                if(type == '2') {
                    document.getElementById('mysound').play();
                    swal("You Have New Appointment From Admin");
                }
            }
            
            messaging.onMessage(function(payload) {
                console.log('Message received. ', payload);
                var type = payload.data.type;
                console.log(type);
                // sweet(type);
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
                var myNotification = new Notification(title, options);
            });
        } else {
            console.log('Firebase Is Not Support');
        }
    </script>
</body>
</html>
