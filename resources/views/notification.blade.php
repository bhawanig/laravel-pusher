@extends('layouts.layout')
<!DOCTYPE html>
<head>
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>
 
   var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
      cluster: '{{env("PUSHER_APP_CLUSTER")}}',
      encrypted: true
    });
 
    var channel = pusher.subscribe('tasks-submit');
    channel.bind('App\\Events\\Notify', function(data) {
        let div = document.createElement('div');
        div.innerHTML = '<div class="card bg-warning"><div class="card-body "><h4 class="card-title">'+data.userName+', <code class="card-text">'+data.title+'</code></h4><p class="card-text text-center">'+data.description+'</p></div></div>';
        document.querySelector(".card-columns").appendChild(div)
    });
  </script>
</head>
@section('content')
<body>
  <h1>Pusher Notification</h1>
  <p>
    Try publishing an event to channel <code>tasks-submit</code>
    with event name <code>tasks-submi</code>.
  </p>

  <div class="card-columns">


  </div>
</body>
@endsection