<!DOCTYPE html>
<html>

<head>

  @include('admin.partials.head')

</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    @include('admin.partials.header')

    <div class="content-wrapper">

      @yield('content')

    </div>
    @include('admin.partials.footer')

  </div>
  @include('admin.partials.scripts')
  @yield('script')
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('b6fd403f25745150148e', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(data.message);
    });
  </script>
</body>

</html>