@extends('welcome')
@section('content')
<div class="container-fluid">
  <div class="company-details row">
    <div class="col-md-4">
      <div class="outer">
        <div class="middle">
          <div class="inner">
            <ul>
              <h4>{{ strtoupper($company->name) }}</h4>
              <p>{{ $company->description }}</p>
              <li>{{ $company->location }}</li>
              <li>{{ $company->phone }}</li>
              <li>{{ $company->email }}</li>
            </ul>
            <div class="inline">
                <div class="row">
                    <form action="{{ url('companies/'.$company->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger custom-bt">Delete company</button>
                    </form>

                <button class="btn btn-warning custom-bt" data-toggle="modal" data-target="#companyModal">Edit company</button>
            </div>
            </div>
          </div>
        </div>
      </div>`
    </div>
    <div class="col-md-8">
        @if(empty($events))
            <div class="row events-header">
                <div class="events-heading">
                    <h4>No Events here</h4>
                </div>
                <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal" data-target="#eventModal">
                    create new event
                </button>
            </div>
            @else
      <div class="row events-header">
        <div class="events-heading">
          <h4>Company Events</h4>
        </div>
        <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal" data-target="#eventModal">
            create new event
          </button>
    </div>
        @endif
    @foreach ($events as $event)
        <div class="card">
          <img src="/{{ $event->image }}">
            <div class="buttons">
                <form action="{{ route('deleteEvent', [$company->id, $event->id]) }}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="delete-button">
                        <img src="/imgs/trash.svg">
                    </button>
                </form>

                <a class="delete-button" data-toggle="modal" data-target="#editEventModal">
                    <img src="/imgs/edit.svg">
                </a>
            </div>
          <div class="info">
            <div class="row">
              <span class="event-name"><b>{{ $event->name }}</b></span>
              <span class="ml-auto"> <img src="/imgs/calendar.svg"> {{ date('d-m-Y', strtotime($event->date)) }}</span>
            </div>
            <hr />
              <p>{{ $event->description }}</p>
              <span>Event Duration: {{  $event->period }} days</span>
              <span>Cost: {{ $event->cost }}</span>
          </div>
        </div>


                <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Event</h5>
                            </div>
                            <div class="modal-body">
                                <form method="POST" class="row" action="{{route('updateEvent', [$company->id, $event->id])}}" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Event name</label>
                                            <input type="text" class="form-control" id="name" value="{{$event->name}}" name="name" placeholder="Event name">
                                        </div>
                                        <div class="form-group">
                                            <label for="location">Event location</label>
                                            <input type="text" class="form-control" id="location" value="{{$event->location}}" name="location" placeholder="Nairobi">
                                        </div>
                                        <div class="form-group">
                                            <label for="cost">Cost</label>
                                            <input type="text" class="form-control" id="cost" value="{{$event->cost}}" name="cost" placeholder="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Start date</label>
                                            <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($event->date)->toDateString() }}" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="period">period in days</label>
                                            <input type="text" class="form-control" id="period" name="period" value="{{$event->period}}" placeholder="1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="activities">Event activities</label>
                                            <input type="text" class="form-control" id="activities" name="activities" value="{{ str_replace('"', '', implode(',', explode(',', trim($event->activities, '[]')))) }}" placeholder="swimming">
                                            <small id="emailHelp" class="form-text text-muted">separate activities with commas.</small>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="company">Package</label>
                                            <span>Event package type</span>
                                            <div class="input-group">
                                                <select id="package" class="form-control form-control-lg" name="package" required>
                                                    <option value="luxury">Luxury</option>
                                                    <option value="mixed">Mixed</option>
                                                    <option value="budget">Budget</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">
                                                {{trim($event->description)}}
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="banner">banner</label>
                                            <input type="file" class="form-control" name="banner" value="{{$event->image}}" id="banner">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary ml-auto">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
    </div>
  </div>
</div>

<div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create new Event</h5>
            </div>
            <div class="modal-body">
                <form class="col-sm-10" method="post" action="{{ url('companies/'.$company->id )}}" enctype="multipart/form-data" >
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">company name</label>
                        <input type="text" class="form-control" id="companyName" name="name" aria-describedby="emailHelp" placeholder="company name" value="{{$company->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">company email</label>
                        <input type="email" class="form-control" id="companyEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{$company->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">company phone</label>
                        <input type="text" class="form-control" id="companyPhone" name="phone" aria-describedby="emailHelp" placeholder="Enter phone" value="{{$company->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">company location</label>
                        <input type="text" class="form-control" id="companyLocation" name="location" aria-describedby="emailHelp" placeholder="company location" value="{{$company->location}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control" id="companyDescription" name="description" rows="3">{{ $company->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Proof document</label>
                        <input type="file" class="form-control" name="proof" id="companyLocation" aria-describedby="emailHelp" placeholder="company location">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

  <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Create new Event</h5>
        </div>
        <div class="modal-body">
            <form method="post" class="row" action="{{url("companies/".$company->id."/event")}}" enctype="multipart/form-data">
              @csrf
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Event name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Event name">
                </div>
                <div class="form-group">
                  <label for="location">Event location</label>
                  <input type="text" class="form-control" id="location" name="location" placeholder="Nairobi">
                </div>
                <div class="form-group">
                    <label for="cost">Cost</label>
                    <input type="text" class="form-control" id="cost" name="cost" placeholder="0">
                  </div>
                  <div class="form-group">
                      <label for="date">Start date</label>
                      <input type="date" class="form-control" id="date" name="date" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="period">period in days</label>
                        <input type="text" class="form-control" id="period" name="period" placeholder="1">
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="activities">Event activities</label>
                            <input type="text" class="form-control" id="activities" name="activities" placeholder="swimming">
                            <small id="emailHelp" class="form-text text-muted">separate activities with commas.</small>
                          </div>
                        <div class="form-group">
                            <label class="sr-only" for="company">Package</label>
                            <span>Event package type</span>
                            <div class="input-group">
                                <select id="package" class="form-control form-control-lg" name="package" required>
                                    <option value="luxury">Luxury</option>
                                    <option value="mixed">Mixed</option>
                                    <option value="budget">Budget</option>

                                </select>
                            </div>
                          </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                      </div>

                      <div class="form-group">
                          <label for="banner">banner</label>
                          <input type="file" class="form-control" name="banner" id="banner">
                        </div>
                      </div>
                <button type="submit" class="btn btn-primary ml-auto">Submit</button>
              </form>
        </div>
      </div>
    </div>
  </div>


<script>
    "use strict";
    !function() {
      var t = window.driftt = window.drift = window.driftt || [];
      if (!t.init) {
        if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
        t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ],
        t.factory = function(e) {
          return function() {
            var n = Array.prototype.slice.call(arguments);
            return n.unshift(e), t.push(n), t;
          };
        }, t.methods.forEach(function(e) {
          t[e] = t.factory(e);
        }), t.load = function(t) {
          var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
          o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
          var i = document.getElementsByTagName("script")[0];
          i.parentNode.insertBefore(o, i);
        };
    }
  }();
  drift.SNIPPET_VERSION = '0.3.1';
  drift.load('itge97evccw7');
  </script>
