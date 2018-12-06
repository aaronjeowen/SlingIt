
<div class="homePageInc">
<h1>Sling It</h1>
<h2>Share your work online with other creators</h2>

  {!! Form::open(['url' => 'search/submit']) !!}
    <div class="form-group formSearch">
      {{Form::text('search', '',['class'=> 'form-control form-input','placeholder'=>'search'])}}
    </div>
  {!! Form::close() !!}


</div>
