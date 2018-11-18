@extends('layouts.app')

@section('content')
<div class="events-list">
    <h2>Upcoming Events</h2>
    <hr/>
@foreach($events as $event)
    <div class="card">
        <img src="/{{ $event->image }}">
        <div class="info">
        <h5>{{ $event->name }}</h5>
        <span class="event-date">
            {{ DateTime::createFromFormat('Y-m-d H:i:s', $event->date)->format('D M d Y') }}
        </span>
        <p>
            {{ $event->description }}
            <span>
                <a href="{{ url("/event/".$event->id."/show") }}">
                    More
                </a>
            </span>
        </p>
        <p class="event-date">price: @ {{ $event->cost }} </p>
        </div>
    </div>

@endforeach
</div>
<!-- Start of Async Drift Code -->
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
<!-- End of Async Drift Code -->


@endsection
