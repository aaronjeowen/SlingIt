@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
  <h1>Posts</h1>
  <!-- Form to filter posts -->
  {!! Form::open(['url' => 'explore/submit']) !!}
   {{Form::select('View', ['All' => 'All', 'Picture' => 'Image','Code' => 'Code'], 'All')}}
   {{Form::submit('Submit',['class'=> 'btn btn-primary'])}}
  {!! Form::close() !!}

  <!--  check if view has been returned with articles-->
  @if(count($articles)>0)
    @foreach($articles as $article)
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 view-item">
      <!--display image or code placeholder  -->
      <?php if ($article->fileType == "image"): ?>
       <a href="/post/{{$article->post_id}}">
         <img class="displayImg" src="<?php echo asset("storage/$article->image")?>"></img>
       </a>
      <?php endif; ?>
      <?php if ($article->fileType == "text"): ?>
        <a href="/post/{{$article->post_id}}">
          <img class="displayPlaceholder" src="<?php echo asset("storage/placeholders/$article->codeType.svg")?>"></img>
        </a>
      <?php endif; ?>
      <!-- Display Text -->
        <h1><a href="/post/{{$article->post_id}}">{{$article->title}}</a></h1>
        {{$article->message}}
    </div>
    @endforeach
  @else
  <!-- check if result for search or filter -->
    @if(isset($search))
    <h2>No results matching: {{$search}}</h2>
    @else
    <h2>No matches</h2>
    @endif
  @endif
</div>
</div>
@endsection
