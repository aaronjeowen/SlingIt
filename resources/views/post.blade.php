@include('inc.messages')

@extends('layouts.app')
@section('content')
<div id='app'></div>
<div class="container">

<h1>{{$articles->title}}</h1><br>
<span class="glyphicon glyphicon-time time-stamp"> </span>{{$articles->created_at->toFormattedDateString()}}<br>
Posted by - <a href="/profile/{{$user->username}}">{{$user->username}}</a>

<?php if ($articles->fileType == "image"): ?>
<div class="row">
  <div class=" postContentHolder">
    <div class="postImageHolder">
      <img class="postImage" src="<?php echo asset("storage/$articles->image")?>"></img>
    </div>
<?php endif; ?>

<?php if ($articles->fileType == "text"): ?>
  <?php $codeFile = file_get_contents("storage/$articles->image");?>
  <?php $user_code = str_replace(array('<','>'), array('&lt;', '&gt;'), $codeFile);?>
   <pre class="code-block language-{{$articles->codeType}}"> <code><?php echo $user_code?> </code></pre>
<?php endif; ?>

<div class="">
  <?php echo $articles->texta ?>
</div>

{!! Form::open(['url' => 'post/download','class' => 'postDownload']) !!}
<input type="hidden" name="postId" value="{{$articles->image}}" class="glyphicon glyphicon-save ">
  <div>
    <button type="submit" class="btn btn-default">
      <span class="glyphicon glyphicon-save"></span>
      <span class="">Download</span>
    </button>
  </div>
{!! Form::close() !!}

{{$articles->message}}<br>

@auth
{!! Form::open(['url' => 'post/submit','class'=>'comments-form']) !!}
<input type="hidden" name="userId" value="{{ Auth::user()->id }}">
<input type="hidden" name="postId" value="{{$articles->post_id}}">
<input type="hidden" value="{{ Auth::user()->username }}" name="username" />
  <div class="form-group">
    <h3>Leave a comment:</h3>
    <div class="form-group">
      <textarea id="summernote" name="comment" placeholder="Enter comment" required></textarea>
    </div>
  </div>
  <div>
    {{Form::submit('Submit',['class'=> 'btn btn-primary'])}}
  </div>
{!! Form::close() !!}

@else
<h3>Please <a href="/login">log in</a> to comment </h3>

@endauth

</div>
</div>
<div class="container">
  <h2>Comments</h2>
@foreach($comments as $comment)
  <div class="comment-block row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
      <a href="/profile/{{$comment->user_username}}">
        <img class="comment-user-thumbnail"src="/storage/avatars/{{$comment->user_username}}.jpg"/></a>
      <p class="comment-user-name">
        <a href="/profile/{{$comment->user_username}}">{{$comment->user_username }}</a>
      </p>
    <div class="comment-body">
      <?php echo $comment->comment ?><br>
    </div>
    </div>
  </div>
@endforeach
</div>

@endsection
