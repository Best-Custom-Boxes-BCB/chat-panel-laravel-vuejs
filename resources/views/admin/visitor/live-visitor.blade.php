@extends('layouts.admin_layout')

@section('content')

<audio id="myAudio">
    <source src="{{ asset('admin-asset/sound/doorbell.mp3') }}" type="audio/mpeg">
    {{-- <source src="{{ asset('admin-asset/sound/notification.mp3') }}" type="audio/mpeg"> --}}
</audio>
<audio id="msgAlert">
    <source src="{{ asset('admin-asset/sound/notification.mp3') }}" type="audio/mpeg">
</audio>


    <section>
        <div class="container">
            <div class="row" id="card_alignment">
                <div class="col-md-12">
                    <div class="card shadow">
                        <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                        <div class="heading m-3">
                            <h3 class="card-title p-3 text-center"> Live Visitor</h3>
                            <hr class="m-0">
                        </div>
                        <div class="card-body">
                            <h5>Realtime visitor</h5>
                            <table class="table shadow" style="margin-bottom: 10rem">
                                <thead>
                                  <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Visitor</th>
                                    <th scope="col">Online</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody id="realtime_visitor_data">

                                </tbody>
                            </table>
                            <input type="text" class="form-control" placeholder="Search visitor...">
                            <table class="table shadow">
                            <h5 class="mt-3">Saved visitor</h5>
                                <thead>
                                  <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Visitor</th>
                                    <th scope="col">Online</th>
                                    <th scope="col">Country</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitors as $data)
                                    {{-- {{ dd($visitor) }} --}}
                                    @if ($data->status == 'deactive')
                                        <tr class=" bg-success shadow" id="visitor_data" data-bs-toggle="modal" data-bs-target="examplemodal">
                                            <input type="hidden" id="ip_address" value="{{ $data->visitor->ip_address }}">
                                            <input type="hidden" id="visitor_id" value="{{ $data->visitor->id }}">
                                            <input type="hidden" id="chat_id" value="{{ $data->id }}">
                                            <input type="hidden"  id="visitor_channel_name" value="{{ $data->visitor->channel_name }}">
                                            <td id="visitor__logo"><img src="{{asset('admin-asset/images/visitor-logo.png')}}" id="visitor_logo" alt=""></td>
                                            <td scope="row">#{{ $data->id }}</td>
                                            <td>{{ $data->created_at->diffForHumans() }}</td>
                                            <td>{{ $data->visitor->country_name }}</td>
                                        </tr>
                                    @else
                                        <tr class="shadow" id="visitor_data" data-bs-toggle="moda" data-bs-target="examplemodal">
                                            <input type="hidden" id="ip_address" value="{{ $data->visitor->ip_address }}">
                                            <input type="hidden" id="visitor_id" value="{{ $data->visitor->id }}">
                                            <input type="hidden" id="chat_id" value="{{ $data->id }}">
                                            <input type="hidden"  id="visitor_channel_name" value="{{ $data->visitor->channel_name }}">
                                            <td id="visitor__logo"><img src="{{asset('admin-asset/images/visitor-logo.png')}}" id="visitor_logo" alt=""></td>
                                            <td scope="row">#{{ $data->id }}</td>
                                            <td>{{ $data->created_at->diffForHumans() }}</td>
                                            <td>{{ $data->visitor->country_name }}</td>
                                        </tr>
                                    @endif

                                    @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('admin.visitor.js.visitor')
    @include('admin.visitor.modal-structure')


@endsection

<script src="{{ asset('admin-asset/js/jquery-3.6.0.min.js') }}"></script>

