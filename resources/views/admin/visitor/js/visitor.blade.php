<script>
    function remove_chat(button){

        // var row = button.closest('tr');
        // alert(row);

        // Get the index of the row within its parent (tbody)
        // var rowIndex = Array.from(row.parentNode.children).indexOf(row);

        // // Remove the row
        // if (rowIndex !== -1) {
        // row.parentNode.removeChild(row);
        // alert("Row at index " + rowIndex + " removed.");
        // }





        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        // rowIndex.parentNode.removeChild(rowIndex);
        }

    $(document).ready(function() {
        // create pusher object
        Pusher.logToConsole = true;
        var pusher = new Pusher('ae8c14b2ef6837815791', {
            cluster: 'ap2'
        });

        startNotificationCHannel();
        // alert(channel_name);

        // $("body").delegate("tr", "click", function() {
        $("body").delegate("tr", "click", function() {
            // ------------------------------
            var rowIndex = $(this).index();
            // alert(rowIndex);
            //  alert('removed');
            //  ------------------------
            const channel_name = $(this).find("#visitor_channel_name").val();
            const ipaddress = $(this).find("#ip_address").val();
            const id = $(this).find("#visitor_id").val();
            const chat_id = $(this).find("#chat_id").val();


            // open modal
            $('.modal').modal('show');



            // Change Notification Status
            $.ajax({
                url: 'change-status/' + chat_id,
                type: "get",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    console.log(res)

                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });


            //Fetch visitor info
            $.ajax({
                url: "{{ route('fetch-visitor-info') }}",
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                },
                success: function(visitorInfo) {
                    console.log(visitorInfo);
                    //  alert('hi');


                    // Append the visitor name.

                    $('#visitor_title').html(
                        '<span>Visitor #' + visitorInfo.data.id + ' | ' + visitorInfo
                        .data.visitor.country_name + '</span>'
                    )
                    $('#visitor_join_title').html(
                        visitorInfo.data.id
                    )
                    $('#agent_id').html(
                        visitorInfo.data.sender_name
                    )

                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });

            $.ajax({
                url: "{{ route('checkMessage') }}",
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ipaddress: ipaddress,
                    id: id,
                },
                success: function(res) {
                    console.log(res)


                    $.each(res.data, function(index, value) {

                        const timestamp = value.created_at;

                        const dateTime = new Date(timestamp);
                        const options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                            timeZoneName: 'short'
                        };

                        const formattedDateTime = dateTime.toLocaleDateString('en-US', options);

                        if (value.from == value.chat.agent_id) {


                            $('#old_messages_area').append(
                                '<div class="row test" style="margin-top:1rem"><div class="col-md-12"><small id="name_title">' +
                                value.sender_name +
                                '</small></div><div class="col-md-12 mt-1"> <small id="msg">' +
                                value.message + '</small> <span id="msg_timestamp" style="font-size:13px">[ ' + formattedDateTime +
                                ' ]</span> </div></div>');

                        } else if (value.message == 'user left') {
                            $('a#old_messages_area').append(
                                '<div class="test" style="align-self: end;margin-top:1rem;position: relative;border-radius: 0.6em;max-width: 50%;padding: 0.2em 0.6em 0.1em 0.6em;text-align: center;color:#000000"><button class="btn btn-dark">' +
                                value.message + '<span id="msg_timestamp" style="font-size:13px"> [ '  + formattedDateTime +' ]</span> </button></div><hr>');

                        } else {
                            $('#old_messages_area').append(
                                '<div class="row test" style="margin-top:1rem"><div class="col-md-12"><small id="name_title">' +
                                value.sender_name +
                                '</small></div><div class="col-md-12 mt-1"> <small id="msg">' +
                                value.message +
                                '</small> <span id="msg_timestamp" style="font-size:13px">[ ' + formattedDateTime + ' ]</span> </div></div>');
                            // '<div style="align-self: flex-start;background-color: #cfcfcf;margin-top:1rem;position: relative;border-radius: 0.6em;max-width: 50%;padding: 0.2em 0.6em 0.1em 0.6em;color:#000000"><p>'+ value.sender_name+ ' : ' +value.message+'</p><small class="">19:12</small></div>');

                        }
                    });

                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });




            // creating pusher connection
            startPusherConnection(channel_name);




            // sending messsage data using ajax
            const ele = document.getElementById('getValue');

            ele.addEventListener('keydown', function(e) {
                // Get the code of pressed key
                const keyCode = e.which || e.keyCode;

                // 13 represents the Enter key
                if (keyCode === 13 && !e.shiftKey) {
                    // Don't generate a new line
                    e.preventDefault();
                    // alert('ready to send request')

                    const message = $('#getValue').val();
                    const username = '{{ Auth::user()->name }}';
                    // const channel_name = $(this).find("#visitor_channel_name").val();
                    const visitor_id = id;
                    const agent_id = `{{ Auth::user()->id }}`;
                    // alert(channel_name);

                    // append message earlier
                    $('.messages_area').append(
                                    '<div style="align-self: end;background-color: #dbf8c6;margin-top:1rem;position: relative;border-radius: 0.6em;max-width: 50%;padding: 0.2em 0.6em 0.1em 0.6em;color:#000000"><p>' +
                                    message + '</p></div>');

                                    // empty the input fields after message send
                                    $('#getValue').val('');



                    $.ajax({
                        url: "{{ url('local-send-message') }}",
                        type: "POST",
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            message: message,
                            username: username,
                            channel_name: channel_name,
                            visitor_id: visitor_id,
                            agent_id: agent_id
                        },
                        success: function(res) {
                            console.log(res);

                            // if (res.success == true) {

                            // }

                            // ------------------------------------
                            // ------------------------------------

                            // $('.messages_area').append(
                            //         '<div style="align-self: end;background-color: #dbf8c6;margin-top:1rem;position: relative;border-radius: 0.6em;max-width: 50%;padding: 0.2em 0.6em 0.1em 0.6em;color:#000000"><p>' +
                            //         message + '</p></div>');

                                    // empty the input fields after message send
                                    $('#getValue').val('');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);

                        }
                    });


                }
            });

        });










        // ---------------------------------
        // All the functions here
        // ---------------------------------

        function removeRowByChannelName(channelName) {
            var table = document.getElementById("realtime_visitor_data");
            var rows = table.getElementsByTagName("tr");
            // alert(channelName);

            // alert(rows.length);
                for (var i = 0; i < rows.length; i++) {
                    var currentChannelName = document.getElementById("visitor_channel_name").value;
                    // alert(i);

                    if (currentChannelName === channelName) {
                        // Remove the row
                        rows[i].remove();
                        console.log('Row has been deleted successfully!');
                        // break; // Assuming there is only one row with the specified channelName
                        // alert('removed!')
                    }else{
                        // alert('not removed!')
                    }
                }
            }

        function startPusherConnection(channel_name) {


            const message___area = document.getElementById('message___area');

            var channel = pusher.subscribe(channel_name);
            // var channel_unsubscribe = pusher.unsubscribe(channel_name);
            // events
            channel.bind('message', function(data) {
                // alert(JSON.stringify(data));
                console.log(data);

                // alert('function done')
                // -------------------------------------
                const name = data.username;
                if (data.username == 'You') {
                    msgSound();
                    $('.messages_area').append(
                        '<div style="align-self: flex-start;background-color: #cfcfcf;margin-top:1rem;position: relative;border-radius: 0.6em;max-width: 50%;padding: 0.2em 0.6em 0.1em 0.6em;color:#000000"><p>' +
                        data.message + '</p></div>');

                }else if (data.username == 'exited') {

                    // remove row when user left
                    removeRowByChannelName(data.channel_name);

                    console.log('row removed user left!');
                    $('.messages_area').append(
                        '<div style="align-self: end;margin-top:1rem;position: relative;border-radius: 0.6em;max-width: 50%;padding: 0.2em 0.6em 0.1em 0.6em;text-align: center;color:#000000"><button class="btn btn-dark">' +
                        data.message + '</button></div>');

                } else {
                    // --------------------------------------
                    // --------------------------------------
                    // $('.messages_area').append(
                    //     '<div style="align-self: end;background-color: #dbf8c6;margin-top:1rem;position: relative;border-radius: 0.6em;max-width: 50%;padding: 0.2em 0.6em 0.1em 0.6em;color:#000000"><p>' +
                    //     data.message + '</p></div>');
                }


                var div = document.getElementById('message___area');
                div.scrollTop = div.scrollHeight;

                function checkScroll() {
                    var div = document.getElementById('message___area');
                    if (div.scrollTop === 0) {
                        div.scrollTop = div.scrollHeight;
                    }
                }

                window.setInterval(checkScroll, 1000);

            });

        }

        function startNotificationCHannel() {
            // alert('Ready');

            var channel = pusher.subscribe('local-notification');
            // var channel_unsubscribe = pusher.unsubscribe(channel_name);
            // events
            channel.bind('notify', function(data) {
                playSound();
                console.log(data);
                // const time = data.visitor.created_at;

                // alert('Notification ready');

                // Convert timestamp in Readable format
                const timestamp = data.visitor.created_at;

                const dateTime = new Date(timestamp);
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    timeZoneName: 'short'
                };

                const formattedDateTime = dateTime.toLocaleDateString('en-US', options);


                $('#realtime_visitor_data').append(
                    `<tr class=" bg-warning shadow " id="visitor_data" data-bs-toggle="modal" data-bs-target="examplemodal">
                            <input type="hidden" id="ip_address" value="` + data.visitor.visitor.ip_address + `">
                            <input type="hidden" id="visitor_id" value="` + data.visitor.visitor.id + `">
                            <input type="hidden" id="chat_id" value="` + data.visitor.id + `">
                            <input type="hidden"  id="visitor_channel_name" value="` + data.visitor.visitor.channel_name + `">
                            <td id="visitor__logo"><img src="{{ asset('admin-asset/images/visitor-logo.png') }}" id="visitor_logo" alt=""></td>
                            <td scope="row">#` + data.visitor.id + `</td>
                            <td>` +formattedDateTime + `</td>
                            <td>` + data.visitor.visitor.country_name + `</td>
                            <td> <button class="btn btn-primary" onclick="remove_chat(this)"> X </button>
                    </tr>`
                );
            });
        }

        function playSound() {
            var sound = document.getElementById('myAudio');
            sound.volume = 1.0;
            sound.play();
        }

        function msgSound() {
            var sound = document.getElementById('msgAlert');
            sound.volume = 1.0;
            sound.play();
        }


    });
</script>
