<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('assetAdmin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assetAdmin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('assetAdmin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('assetAdmin/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assetAdmin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assetAdmin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('assetAdmin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('assetAdmin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assetAdmin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('assetAdmin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assetAdmin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assetAdmin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assetAdmin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- jquery-validation -->
<script src="{{asset('assetAdmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assetAdmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assetAdmin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assetAdmin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assetAdmin/dist/js/demo.js')}}"></script>
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


<script>
	
	$.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

	//Datatable
  	$(function () {
	    $("#example1").DataTable({
	      	"responsive": true,
	      	"autoWidth": false,
	    });
	    //Initialize Select2 Elements
    	$('.select2').select2()
	});

  	//Validation
	$(document).ready(function () {
  		$.validator.setDefaults({
		    // submitHandler: function () {
		    //   alert( "Form successful submitted!" );
		    // }
	  	});
	  	$('#quickForm').validate({
		    rules: {
		    	username: {
		    		required: true,
		    		maxlength: 50
		    	},
		    	first_name: {
		    		required: true,
		    		maxlength: 25
		    	},
		    	last_name: {
		    		required: true,
		    		maxlength: 25
		    	},
		    	phone: {
		    		required: true,
		    		maxlength: 15
		    	},
		      	email: {
			        required: true,
			        email: true,
		      	},
		      	birth_of_date: {
		    		required: true,
		    		date: true
		    	},
		    	gender: {
		    		required: true
		    	},
		    	country: {
		    		required: true
		    	},
		    	occupation: {
		    		required: false,
		    		maxlength: 50
		    	},
		      	password: {
			        required: true,
			        minlength: 6
		      	},
		      	specialize_title: {
		      		required: true,
		      		maxlength: 50
		      	},
		      	specialize_description: {
		      		required: true,
		      		maxlength: 120
		      	},
		      	specialization: {
		      		required: true
		      	},
		      	doctor_start: {
		      		required: true
		      	},
		      	doctor_end: {
		      		required: true
		      	},
		      	pain_name: {
		      		required: true,
		      		maxlength: 50
		      	},
		      	country_name: {
		      		required: true,
		      		maxlength: 50
		      	},
		      	appointment_date: {
		      		required: true,
		      		date: true
		      	},
		      	appointment_time: {
		      		required: true
		      	},
		      	patient: {
		      		required: true
		      	},
		      	doctor: {
		      		required: true
		      	}
		    },
		    messages: {
		    	username: {
		    		required: "Please enter Username",
		    		maxlength: "Your Username must be at most 50 characters long"
		    	},
		    	first_name: {
		    		required: "Please enter Your First Name",
		    		maxlength: "Your First Name must be at most 25 characters long"
		    	},
		    	last_name: {
		    		required: "Please enter Your Last Name",
		    		maxlength: "Your Last Name must be at most 25 characters long"
		    	},
		    	phone: {
		    		required: "Please enter Your Phone Number",
		    		maxlength: "Your Phone must be at most 15 Numbers"
		    	},
		      	email: {
		        	required: "Please Enter Your  Email Address",
		        	email: "Please Enter a Vaild Email Address"
		      	},
		      	birth_of_date: {
		    		required: "Please enter Your Birth Of Date"
		    	},
		    	gender: {
		    		required: "Please Choose Your Gender"
		    	},
		    	country: {
		    		required: "Please Choose Your Country"
		    	},
		    	occupation: {
		    		maxlength: "Your Occupation must be at most 50 characters long"
		    	},
		      	password: {
		        	required: "Please provide a password",
		        	minlength: "Your password must be at least 6 characters long"
		      	},
		      	specialize_title: {
		      		required: "Please Enter Specialization Title",
		      		maxlength: "Specialization Title must be at most 50 characters long"
		      	},
		      	specialize_description: {
		      		required: "Please Enter Specialization Description",
		      		maxlength: "Specialization Description must be at most 120 characters long"
		      	},
		      	specialization: {
		    		required: "Please Choose Specialization"
		    	},
		    	doctor_start: {
		      		required: "Please Enter Start Time Available"
		      	},
		      	doctor_end: {
		      		required: "Please Enter End Time Available"
		      	},
		      	pain_name: {
		      		required: "Please Enter Pain Name",
		      		maxlength: "Pain name must be at most 50 characters long"
		      	},
		      	country_name: {
		      		required: "Please Enter Country Name",
		      		maxlength: "Country name must be at most 50 characters long"
		      	},
		      	appointment_date: {
		      		required: "Please Enter Appointment Date"
		      	},
		      	appointment_time: {
		      		required: "Please Enter Appointment Time"
		      	},
		      	patient: {
		      		required: "Please Choose Patient Name"
		      	},
		      	doctor: {
		      		required: "Please Choose Doctor Name"
		      	}
		    },
		    errorElement: 'span',
		    errorPlacement: function (error, element) {
		      	error.addClass('invalid-feedback');
		      	element.closest('.form-group').append(error);
		    },
		    highlight: function (element, errorClass, validClass) {
		      	$(element).addClass('is-invalid');
		    },
		    unhighlight: function (element, errorClass, validClass) {
		      	$(element).removeClass('is-invalid');
		    }
	  	});

	  	$('#quickFormEdit').validate({
		    rules: {
		    	username: {
		    		required: true,
		    		maxlength: 50
		    	},
		    	first_name: {
		    		required: true,
		    		maxlength: 25
		    	},
		    	last_name: {
		    		required: true,
		    		maxlength: 25
		    	},
		    	phone: {
		    		required: true,
		    		maxlength: 15
		    	},
		      	email: {
			        required: true,
			        email: true,
		      	},
		      	birth_of_date: {
		    		required: true,
		    		date: true
		    	},
		    	gender: {
		    		required: true
		    	},
		    	country: {
		    		required: true
		    	},
		    	occupation: {
		    		required: false,
		    		maxlength: 50
		    	},
		      	password: {
			        required: false,
			        minlength: 6
		      	},
		      	specialization: {
		      		required: true
		      	},
		      	doctor_start: {
		      		required: true
		      	},
		      	doctor_end: {
		      		required: true
		      	}
		    },
		    messages: {
		    	username: {
		    		required: "Please enter Username",
		    		maxlength: "Your Username must be at most 50 characters long"
		    	},
		    	first_name: {
		    		required: "Please enter Your First Name",
		    		maxlength: "Your First Name must be at most 25 characters long"
		    	},
		    	last_name: {
		    		required: "Please enter Your Last Name",
		    		maxlength: "Your Last Name must be at most 25 characters long"
		    	},
		    	phone: {
		    		required: "Please enter Your Phone Number",
		    		maxlength: "Your Phone must be at most 15 Numbers"
		    	},
		      	email: {
		        	required: "Please Enter Your  Email Address",
		        	email: "Please Enter a Vaild Email Address"
		      	},
		      	birth_of_date: {
		    		required: "Please enter Your Birth Of Date"
		    	},
		    	gender: {
		    		required: "Please Choose Your Gender"
		    	},
		    	country: {
		    		required: "Please Choose Your Country"
		    	},
		    	occupation: {
		    		maxlength: "Your Occupation must be at most 50 characters long"
		    	},
		      	password: {
		        	required: "Please provide a password",
		        	minlength: "Your password must be at least 6 characters long"
		      	},
		      	specialization: {
		    		required: "Please Choose Specialization"
		    	},
		    	doctor_start: {
		      		required: "Please Enter Start Time Available"
		      	},
		      	doctor_end: {
		      		required: "Please Enter End Time Available"
		      	}
		    },
		    errorElement: 'span',
		    errorPlacement: function (error, element) {
		      	error.addClass('invalid-feedback');
		      	element.closest('.form-group').append(error);
		    },
		    highlight: function (element, errorClass, validClass) {
		      	$(element).addClass('is-invalid');
		    },
		    unhighlight: function (element, errorClass, validClass) {
		      	$(element).removeClass('is-invalid');
		    }
	  	});
	});

	//Alert Delete
    $(document).on('click', '.alerts', function(e){
        var url = $(this).data("url");
        var id = $(this).data("id");
        var table = '.' + $(this).data('table');
        var thisClick = $(this).parents('tr');
        e.preventDefault();
        console.log(url);
        swal({
            title: "Are You Sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'DELETE',
                    url: url+id,
                    data: {id: id},
                    success:function(data){
                        var datatable = $(table).DataTable();
                        datatable.row(thisClick).remove().draw();
                        swal("Good job!", "Deleted Successfully!", "success");
                    }
                });
            } else {
                swal("ERROR!", "Delete Failed!", "error");
            }
        });
    });

    //Alert Status Doctor
        $(document).on('click', '.alertStatusDoctor', function(e){
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
                    url: "{{ route('doctorAppointmentStatus') }}",
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
                url: '{{route('getToken')}}',
                headers: {
                	Accept: 'application/json'
                },
                success: function(result){
                    console.log(result);
                }
            });
        }

        function notificationCount(){
        	$.ajax({
                cache: false,
                type: 'GET',
                url: '{{ url(route('notification_count')) }}',
                success:function(data){
                    $('.notificationCount').text(data);
                }
            });
        }

        function sweet(type){
            if(type == '1') {
                $.ajax({
                    cache: false,
                    type: 'GET',
                    url: '{{ url(route('order_count')) }}',
                    success:function(data){
                        $('.orderCount').text(data);
                    }
                });

                $.ajax({
                    cache: false,
                    type: 'GET',
                    url: '{{ url(route('order_notify')) }}',
                    success:function(data){
                        document.getElementById('mysound').play();
                    }
                });
                
                notificationCount();
                swal("New Order From Patient");
            } else {
            	$.ajax({
                    cache: false,
                    type: 'GET',
                    url: '{{ url(route('appointment_count')) }}',
                    success:function(data){
                        $('.appointmentCount').text(data);
                    }
                });

                $.ajax({
                    cache: false,
                    type: 'GET',
                    url: '{{ url(route('appointment_notify')) }}',
                    success:function(data){
                        document.getElementById('mysound').play();
                    }
                });

                notificationCount()
                swal("Rejected Appointment From Patient");
            }
        }
        
        messaging.onMessage(function(payload) {
            console.log('Message received. ', payload);
            var type = payload.data.type;
            console.log(type);
            sweet(type);
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