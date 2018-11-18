@extends('welcome')
@section('content')

<div class="charts dashboard-container">
    <div class="row mt-5">
      <div class="col-sm-12 info-card">
        <div class="image-header">
            <img src="{{ Auth::user()->avatar }}">
        </div>
        <div>
          <h4 class="dash-header">Welcome {{ Auth::user()->name }}</h4>
        </div>
        <div class="ml-auto header-details">
          <p>companies</p>
          <h4>{{ $mycompanies }}</h4>
        </div>
        <div class="header-details">
          <p>events</p>
          <h4>{{ $myevents }}</h4>
      </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="stats-card col-sm-3 mr-4 mb-5">
        <div class="info">
          <img src="/imgs/team.svg" alt="user icon">
          <h4>{{ $allusers }}</h4>
          <h6> Registered users </h6>
        </div>
      </div>
      <div class="stats-card col-sm-3 mr-4 mb-5">
        <div class="info">
          <img src="/imgs/enterprise.svg" alt="company icon">
          <h4>{{ $allcompanies }}</h4>
          <h6> Registered companies </h6>
        </div>
      </div>

      <div id="chart-div" class="stats-card end col-sm-5"></div>
      @piechart('IMDB', 'chart-div')
    </div>
    <div class="row mb-5">
        <div id="pop_div" class="stats-card xend col-sm-6"></div>
        @linechart('Temps', 'pop_div')

      <div id="poll_div" class="stats-card end col-sm-5"></div>
      @barchart('Requests', 'poll_div')
    </div>

    </div>
</div>
@endsection

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
  