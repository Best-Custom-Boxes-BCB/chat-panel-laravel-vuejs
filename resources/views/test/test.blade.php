<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    * {
        box-sizing: border-box;
    }

    /* Button used to open the chat form - fixed at the bottom of the page */
    .open-button {
        background: linear-gradient(90deg, rgba(4, 16, 52, 1) 28%, rgba(9, 45, 167, 1) 100%) !important;
        color: white;
        padding: 4px 0px;
        border: none;
        cursor: pointer;
        opacity: 1;
        position: fixed;
        bottom: 0px;
        right: 12px;
        width: 160px;
    }

    /* The popup chat - hidden by default */
    .chat-popup {
        /* display: none; */
        position: fixed;
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
        max-width: 300px;
        padding: 10px;
        background-color: white;
    }

    /* Full-width textarea */
    .form-container textarea {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
        resize: none;
        min-height: 200px;
    }

    /* When the textarea gets focus, do something */
    .form-container textarea:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Set a style for the submit/send button */
    .form-container .btn {
        background-color: #04AA6D;
        color: white;
        padding: 3px 0px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom: 10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover,
    .open-button:hover {
        opacity: 1;
    }

    #header {
        background: linear-gradient(90deg, rgba(4, 16, 52, 1) 28%, rgba(9, 45, 167, 1) 100%) !important;
        color: white;
        /* justify-content: center; */
    }

    #minimize-area {
        text-align: end;
    }

    #heading {
        text-align: end;
    }

    #messages_area {
        height: 150px
    }

    #messages_area #name_title {
        padding: 4px;
        background-color: #04AA6D;
        color: white;
    }

    #messages_area #msg {
        padding: 5px;
        background-color: #ddd
    }
</style>



<body>

    {{-- OEefDZmIuc,v --}}

    <section class="m-3">
        <p>Fetching the ip address</p>
        <input type="text" id="ip_address" value="{{ $_SERVER['REMOTE_ADDR'] }}">
        <button class="btn btn-warning" onclick="ChatExit()">Exit Chat</button>
    </section>
    <button class="open-button" onclick="openForm()"> <i class="fa fa-comments" aria-hidden="true"></i> chat with
        us</button>

    <div class="chat-popup" id="myForm">
        <audio id="clientSound">
            <source src="{{ asset('admin-asset/sound/client-sound.mp3') }}" type="audio/mpeg">
        </audio>
        <form class="form-container">
            <div class="row" id="header">
                <small class="col-md-8" id="heading">Live Support</small>
                <small class="col-md-4" id="minimize-area">
                    <i onclick="closeForm()" class="fa fa-minus"aria-hidden="true"></i>
                </small>
            </div>
            <div class="navbar">
                <div class="row">
                    <div class="col-md-3 p-0">
                        <img class="shadow" src="{{ asset('admin-asset/images/customer-service.png') }}"
                            style="width: 50px" alt="customer-service">
                    </div>
                    <div class="col-md-9 pl-4">
                        <p class="m-0">Live Support</p>
                        <small>Ask us anything </small>
                    </div>
                </div>
            </div>
            <hr>
            <div class="messages pl-3" id="messages_area" style="overflow-x: hidden">
                {{-- You messages shown here --}}
            </div>
            <hr>
            <div class="send_messages">
                <textarea type="text" required="" style="width: 100%;min-height:0px" id="getValue" placeholder="Type your message here..." class="form-control"></textarea>
                {{-- <input type="text" class="form-control" placeholder="Type message.." id="getValue" required /> --}}
                {{-- <button type="button" id="sendMessage" class="btn">Send</button> --}}
            </div>


        </form>
    </div>
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
        function endchat(){

            var pusher = new Pusher('ae8c14b2ef6837815791', {
                cluster: 'ap2'
            });

            var channel = pusher.subscribe(channel_name);
            channel.unsubscribe();
        }



         //   user exit the chat send the signal message to the Agent
         function ChatExit(){
                const channel__name = $('#channel_name').val();
                const visitor_id = $('#visitor_id').val();

                $.ajax({
                        url: "tab-close",
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            visitor_id: visitor_id,
                            channel_name: channel__name
                        },
                        success: function(response) {
                            console.log(response);
                        }
                    });
            }

    </script>
    <!-- Optional JavaScript -->
    {{-- <!-- jQuery first, then Popper.js, then ? JS --> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="{{asset('admin-asset/vendor/js/bootstrap.js')}}">
    </script>
</body>



<script>
    $(document).ready(function() {

        // create 6-digit string for channel name
        const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let channel_name = '';
        let length = 6;
        const charactersLength = characters.length;
        for ( let i = 0; i < length; i++ ) {
            channel_name += characters.charAt(Math.floor(Math.random() * charactersLength));
        }




        $.ajax({
            // alert('hi'),
            url: "local-visitor",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                ip_address: "{{ $_SERVER['REMOTE_ADDR'] }}",
                channel_name: channel_name
            },
            success: function(response) {
                console.log(response);
                $('.send_messages').append('<input type="hidden" id="visitor_id" value='+response.data.id+'>');
                $('.send_messages').append('<input type="hidden" id="channel_name" value='+channel_name+'>');
            }
        });

        // alert(channel_name);
        const ele = document.getElementById('getValue');

            ele.addEventListener('keydown', function(e) {
                // Get the code of pressed key
                const keyCode = e.which || e.keyCode;

                // 13 represents the Enter key
                if (keyCode === 13 && !e.shiftKey) {
                    // Don't generate a new line
                    e.preventDefault();
                    // alert('ready to send request')

                // $('#getValue').keypress(function (e) {
                //     if (e.which == 13) {

                    // $("#sendMessage").click(function() {

                const message = $('#getValue').val();
                const username = 'You';
                const visitor_id = $('#visitor_id').val();

                // append message earlier
                $('#messages_area').append(
                    '<div class="row" style="margin-top:1rem"><div class="col-md-12"><small id="name_title"> You </small></div><div class="col-md-12"> <small id="msg">' + message + '</small></div></div>');
                    $('#getValue').val('');

                // return alert(visitor_id);

                // alert('hi')
                $.ajax({
                    url: "local-send-message",
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        message: message,
                        username: username,
                        channel_name: channel_name,
                        visitor_id: visitor_id,
                    },
                    success: function(res) {
                        console.log(res);

                        // empty the input fields
                        // $('#getValue').val('');
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
                return false;
            }
        });



        // $('input[name="username"]').on('keyup', function() {
        //     const title = $(this).val();
        //     $('#Name').html(title);
        // });


        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('ae8c14b2ef6837815791', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe(channel_name);
        // events
        channel.bind('message', function(data) {
                // alert(JSON.stringify(data));
                const name = data.username;
                if (data.username == 'You') {
                    // $('#messages_area').append(
                    //     '<div class="row" style="margin-top:1rem"><div class="col-md-12"><small id="name_title">' + data.username + '</small></div><div class="col-md-12"> <small id="msg">' + data.message + '</small></div></div>');
                } else {
                    clientMsgSound();
                    $('#messages_area').append(
                        '<div class="row" style="margin-top:1rem"><div class="col-md-12"><small id="name_title">' + data.username + '</small></div><div class="col-md-12"> <small id="msg">' + data.message + '</small></div></div>');
                }
                var div = document.getElementById('messages_area');
                div.scrollTop = div.scrollHeight;

                function checkScroll() {
                    var div = document.getElementById('messages_area');
                        if (div.scrollTop === 0) {
                            div.scrollTop = div.scrollHeight;
                        }
                    }
                window.setInterval(checkScroll, 1000);
        });

        function clientMsgSound() {
        var sound = document.getElementById('clientSound');
        sound.volume = 1.0;
        sound.play();
  }



        });
        window.addEventListener('unload', function() {
            ChatExit();
        });

</script>

</html>
