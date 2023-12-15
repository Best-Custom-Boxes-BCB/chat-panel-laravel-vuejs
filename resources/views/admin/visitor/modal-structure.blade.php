  <!-- Modal -->
  <div class="modal fade" id="examplemodal"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-white" id="exampleModalLabel">
                <img src="{{asset('admin-asset/images/visitor-logo.png')}}" id="visitor_logo" alt="">
                <span id="visitor_title"></span>
            </h5>
          <button type="button" onclick="cleanModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                {{-- right column --}}
                <div class="col-md-8 shadow p-3" id="message__area__background">
                    <div class="row">
                        <div class="heading text-center">
                            {{-- <p id="agent_id"> </p> --}}
                            <p> <span id="agent_id"></span> has joined.</p>
                            <p> Visitor #<span id="visitor_join_title"></span> has joined.</p>
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="row">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#new_chat" type="button" role="tab" aria-controls="pills-home" aria-selected="true">New Chat</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#old_chat" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Old Chat</button>
                            </li>
                          </ul>
                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="new_chat" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="messages_area" id="message___area">
                                    <i>--Latest message--</i>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="old_chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="messages_area" id="old_messages_area">
                                    <i>--Old messages--</i>
                                </div>
                            </div>

                          </div>
                    </div>
                    <div class="row sending_message m-3">
                            <textarea type="text" required="" style="width: 100%" id="getValue" placeholder="Type your message here..." class="form-control"></textarea>
                            {{-- <button style="width: 20%"  id="sendMessage" class="btn btn-success">Send</button> --}}
                    </div>
                </div>


                {{-- right column --}}
                <div class="col-md-4 shadow p-3" id="visitor__area">
                    <div class="row"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>


  <script>
       function cleanModal(){
            // alert('hi');
             $("#message___area").html('');
                // console.log('model cleaned');
             $("#old_messages_area").html('');
                console.log('model cleaned');
    }
  </script>
