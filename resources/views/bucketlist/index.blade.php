@extends('welcome')
@section('content')
<div class="container">
    <div class="events-heading">
        <h4>User Categories</h4>
      </div>
      <p class="notice"> Pick (click) categories you want to notified about then save</p>
  <div class="categories">
    <div class="hiddenCB">
      <form class="" action="/bucketlist" method="post">
        @csrf
        <div class="row categories">
        @foreach($categories as $category)
          <input type="checkbox" name="choice[]" id="{{$category->id}}" value="{{$category->id}}" />
            <label for="{{$category->id}}">{{$category->name}}</label>
        @endforeach
        <div class="form-group">
          <button class="btn btn-warning" type="submit">save bucketlist</button>
        </div>
      </div>
      </form>
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
