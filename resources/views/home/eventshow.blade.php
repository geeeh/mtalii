@extends('layouts.app')
@section('content')
    <div class="eventshow">
        <div class="event-header" >
            <h1>
                {{ $event->name }}
            </h1>
        </div>

        <div class="event-details">
            <span>
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 52 52" style="enable-background:new 0 0 52 52;" xml:space="preserve" width="18px" height="18px" >
           <path style="fill:#1081E0;" d="M38.853,5.324L38.853,5.324c-7.098-7.098-18.607-7.098-25.706,0h0
               C6.751,11.72,6.031,23.763,11.459,31L26,52l14.541-21C45.969,23.763,45.249,11.72,38.853,5.324z M26.177,24c-3.314,0-6-2.686-6-6
               s2.686-6,6-6s6,2.686,6,6S29.491,24,26.177,24z"/></svg>
               {{ $event->location }}
            </span>
            <span><img src="/imgs/money.svg">{{ $event->cost }}</span>
            <span><img src="/imgs/clock.svg">{{ date("jS F, Y", strtotime($event->date)) }}</span>
        </div>
        <div class="event-image">
            <img src="/{{ $event->image }}">
        </div>

        <div class="event-description">
            <p class="p-description">
                {{ $event->description }}
            </p>
        </div>

        <div class="event-button">
            <a class="col-sm-6 interested" href="" data-toggle="modal" data-target="#myModal">
                <button class="btn btn-warning btn-lg">Show interest</button>
            </a>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">send details</h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-group" method="post" action="/event/{{$event->id}}/send">
                            @csrf
                            <input type="hidden" value="{{$event->name}}" name="name">

                            <div class="form-group">
                                <label class="sr-only" for="email">Email</label>
                                <span>User Email</span>
                                <div class="input-group">
                                    <input type="email" id="email" class="form-control"  name="email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="phone">Phone</label>
                                <span>user Phone</span>
                                <div class="input-group">
                                    <input type="text" id="phone" class="form-control"  name="phone" required>
                                </div>
                            </div>
                            <div class="form-group buttons">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
