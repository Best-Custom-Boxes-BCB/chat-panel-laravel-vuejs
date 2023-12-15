<script>
     $(document).ready(function() {
            const channel_name = $(this).find("#visitor_channel_name").val();

            $( "body" ).delegate( "tr", "click", function() {
                const id = $(this).find("#visitor_id").val();
                const uniqueModelName = 'visitor'+id;
                uniqueModal(uniqueModelName);


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

                            // Append the visitor name.

                            $('#visitor_title').html(
                                '<span>Visitor #'+ visitorInfo.data.id +'</span>'
                            )

                        },
                        error: function(xhr) {
                            console.log(xhr);
                        }
                });


                // creating pusher connection

                Pusher.logToConsole = true;

                var pusher = new Pusher('ae8c14b2ef6837815791', {
                    cluster: 'ap2'
                });
                var channel = pusher.subscribe(channel_name);
                // var channel_unsubscribe = pusher.unsubscribe(channel_name);
                // events
                channel.bind('message', function(data) {
                    // alert(JSON.stringify(data));
                    const name = data.username;
                    if (data.username == 'You') {
                        $('.messages_area').append(
                            '<div style="align-self: flex-start;background-color: #FFFFFF;margin-top:1rem;position: relative;border-radius: 0.6em;max-width: 50%;padding: 0.2em 0.6em 0.1em 0.6em;color:#000000"><p>'+ data.message + '</p><small class="">19:12</small></div>');
                    } else {
                        $('.messages_area').append(
                            '<div style="align-self: end;background-color: #dbf8c6;margin-top:1rem;position: relative;border-radius: 0.6em;max-width: 50%;padding: 0.2em 0.6em 0.1em 0.6em;color:#000000"><p>'+ data.message + '</p><small class="">19:12</small></div>');
                    }
                });



                // sending messsage data using ajax


                  $("#sendMessage").click(function() {

                const message = $('#getValue').val();
                // const username = 'You';
                const username = '{{ Auth::user()->name }}';
                // const channel_name = $(this).find("#visitor_channel_name").val();
                // alert(channel_name);



            $.ajax({
                url: "{{ route('send-message') }}",
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    message: message,
                    username: username,
                    channel_name: channel_name
                },
                success: function(res) {
                    return console.log(res);
                    if (res.success == true) {

                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });



            });





            // ------------------------------------
            // All Your Functions here
            // ------------------------------------
            function uniqueModal(id){
                // alert(id)
                $(".modal").attr("id",id);
                const name1 = '#'+id;
                $(name1).modal('show');
            }

        });
</script>
