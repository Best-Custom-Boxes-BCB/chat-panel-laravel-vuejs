@extends('layouts.admin_layout')

<link rel="stylesheet" href="{{ asset('admin-asset/css/chat_style.css') }}">


@section('content')

                <section class="a1-row container">
                    <aside class="a1-column aside">
                        <div
                            class="a1-row a1-center-items-v a1-justify-items a1-half-padding-tb a1-padding-lr bg-left-panel-header a1-spaced-items border-r">
                            <img src="https://i.ibb.co/KK52Gp5/aviv-profile.jpg" class="profile-pic" alt="Profile Picture">
                            <div class="a1-row a1-spaced-items a1-center-items-v icon-color">
                                <i class="bx bx-moon" onclick="toggle()"></i>
                                <i class="fas fa-circle-notch"></i>
                                <i class="fas fa-comment-alt"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                        </div>
                        <div class="a1-row a1-center-items-v a1-padding a1-spaced-items search">
                            <i class="fas fa-search icon-color"></i>
                            <input type="text" class="a1-long form-control" placeholder="Search or start new chat">
                        </div>
                        <div class="a1-column a1-long a1-elastic friends-panel" style="height: 0px">
                            @foreach ($visitors as $visitor)

                                    <div id="click_get_id"  class="visitor-box a1-row a1-center-items-v a1-padding a1-justify-items a1-spaced-items border-b friend active">
                                        <img src="https://i.ibb.co/fnBBPZp/old-man.jpg" class="profile-pic side-friend-profile-pic"
                                            alt="Profile Picture">
                                        <div class="a1-column a1-long a1-elastic">
                                            <input type="hidden" id="visitor_id" value="{{ $visitor->id }}">
                                            <input type="hidden"  id="visitor_channel_name" value="{{ $visitor->channel_name }}">
                                                <div class="a1-row a1-long a1-elastic">
                                                    <span class="a1-long a1-elastic">visitor #{{ $visitor->id }}</span>
                                                    <span class="timestamp">{{ $visitor->created_at->diffForHumans() }}</span>
                                                </div>

                                            <div class="a1-row a1-center-items-v a1-justify-items a1-long">
                                                <span class="message-preview">
                                                    <i class="fas fa-check-double blue"></i>
                                                    <span>country : {{ $visitor->country_name }}</span>
                                                </span>
                                                <div class="a1-row a1-center-items-v a1-half-spaced-items">
                                                    <div class="a1-row a1-center-items-h a1-center-items-v pin-wrap">
                                                        <i class="fas fa-map-pin"></i>
                                                    </div>
                                                    <i class="fas fa-chevron-down icon-color"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                            @endforeach
                            {{-- <div
                                class="a1-row a1-center-items-v a1-padding a1-justify-items a1-spaced-items border-b friend">
                                <img src="https://i.ibb.co/0nvDvbw/noam.jpg" class=" profile-pic side-friend-profile-pic"
                                    alt="Profile Picture">
                                <div class="a1-column a1-long a1-elastic">
                                    <div class="a1-row a1-long a1-elastic">
                                        <span class="a1-long a1-elastic">Noam</span>
                                        <span class="timestamp">23:44</span>
                                    </div>
                                    <div class="a1-row a1-center-items-v a1-justify-items a1-long">
                                        <span class="message-preview">K, I'm waiting</span>

                                        <div class="a1-row a1-center-items-v a1-half-spaced-items">
                                            <span class="a1-row a1-center-items-h a1-center-items-v notification">3</span>
                                            <i class="fas fa-chevron-down icon-color"></i>

                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                    </aside>
                    <main class="a1-column main">
                        <div
                            class="a1-row a1-center-items-v a1-justify-items a1-half-padding-tb a1-padding-lr bg-left-panel-header a1-spaced-items">
                            <div class="a1-row a1-center-items-v a1-spaced-items">
                                <i class="fas fa-chevron-left blue back-arrow"></i>
                                <img src="https://i.ibb.co/fnBBPZp/old-man.jpg" class="profile-pic"
                                    alt="Profile Picture">
                                    <div id="visitor_name">
                                        <span>My Old Man</span>

                                    </div>
                            </div>

                            <div class="a1-row a1-spaced-items a1-center-items-v icon-color">
                                <i class="bx bx-search"></i>
                                <i class="bx bx-paperclip"></i>
                                <i class="bx bx-dots-vertical"></i>
                            </div>
                        </div>

                        <div class="a1-column a1-long a1-elastic">
                            <div class="chat-container a1-column a1-long a1-elastic chat-main a1-spaced-items"  id="messages_area">


                                {{-- <div class="text text-recieved mt-3" >

                                </div> --}}

                                {{-- <div class="text text-sent">
                                    <p>On my way dad</p>
                                    <div class="a1-row a1-end a1-half-spaced-items timestamp">
                                        <span>19:13</span>
                                        <i class="fas fa-check-double blue"></i>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="a1-row a1-spaced-items a1-center-items-v a1-padding bg-left-panel-header">
                                <i class="bx bx-happy fa-1half"></i>
                                <input type="text" class="a1-long chat-input" id="getValue" placeholder="Type a message">
                                <i class="btn btn-success" id="sendMessage">Send</i>
                            </div>
                        </div>
                    </main>
                </section>


                @include('admin.chats.js.index')

@endsection

<script src="{{ asset('admin-asset/js/jquery-3.6.0.min.js') }}"></script>


