<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SlingIt</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/prism.css">
    <link rel="stylesheet" href="/css/style.css">

    <script type="text/javascript"src="/js/prism.js"></script>
    <script type="text/javascript"src="/js/custom.js"></script>
    <script type="text/javascript"src="/js/fontawesome-all.js"></script>

    <script type="text/javascript"src="/js/app.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script type="text/javascript"src="/js/jq.js"></script>

  </head>
  <body>
      @if(Request::is('/'))
      <div class="page">
        <div class="background-full">
          @include('inc.navbar')
        </div>
        <div class="container coverPage">
          <div class="row">
            <div class="col-lg-12 ">
              @include('inc.homePage')
            </div>
          </div>
        </div>
      </div>
    @else
      @include('inc.navbar')
      @yield('content')
    @endif
<script>
  $(document).ready(function() {
      $('#summernote').summernote();
  });
</script>
  </body>

</html>
