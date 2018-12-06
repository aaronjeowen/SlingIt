@extends('layouts.app')
@section('content')
<div class="container profile-container">
  <div class="row">
    <div class="col-md-12 profile-header">

    </div>
</div>
  <div class="row">
    <div class="col-md-4 profile-card">
      <img src="/storage/avatars/{{ $user->avatar}}" class="profile-avatar"alt="user profile avatar"><br>
      <h1>{{ $user->name }}</h1>
      @if($user->occupation)
      <h3>{{$user->occupation}}</h3>
      @endif
      @if($user->description)
      <p>{{$user->description}}</p>
      @endif
      @if($user->twitter)
      <div class="profile-social-holder">
        <i class="fab fa-twitter fa-2x"></i><p>{{$user->twitter}}</p>
      </div>
      @endif
      @if($user->github)
      <div class="profile-social-holder">
        <i class="fab fa-github fa-2x"></i><p>{{$user->github}}</p><br>
      </div>
      @endif
      @if($user->dribbble)
      <div class="profile-social-holder">
        <i class="fab fa-dribbble fa-2x"></i><p>{{$user->dribbble}}</p><br>
      </div>
      @endif
      @if($user->website)
      <div class="profile-social-holder">
        <i class="fas fa-globe fa-2x"></i><p>{{$user->website}}</p><br>
      </div>
      @endif

      @auth
      @if($user->name == Auth::user()->name)
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Edit Profile
      </button>
      @endif
      @endauth
    </div>

    <div class="col-md-8">
      <h1>Posts</h1>
      @if(count($articles)>0)
        @foreach($articles as $article)
        <div class="col-lg-4 col-md-4  col-sm-3 col-xs-8  profile-item">
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
            <h1><a href="/post/{{$article->post_id}}">{{$article->title}}</a></h1>
            <?php echo $article->texta?></li>
        </div>

        @endforeach
      @endif

    </div>

      <!-- Modal -->
      @auth
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
            </div>
            <div class="modal-body">
              {!! Form::open(['url' => 'profile/'.$user->username.'/submit','files'=>'true']) !!}

              <div class="form-group">
                {{Form::label('avatar', 'Avatar')}}<br>
                <img src="/storage/avatars/{{ Auth::user()->avatar}}" class="user-edit-thumb"alt="user avatar">
                <input type="file" name="avatar" value="hey"@if($user->avatar!="") value="{{$user->avatar}}" @endif>
              </div>

              <div class="form-group">
                {{Form::label('occupation', 'Occupation')}}
                <input type="text" class="form-control" name="occupation" @if($user->occupation!="") value="{{$user->occupation}}" @else  placeholder="Occupation" @endif>
              </div>

              <div class="form-group">
                {{Form::label('description', 'Description')}}
                <input type="text" class="form-control" name="description" @if($user->description!="") value="{{$user->description}}" @else  placeholder="description" @endif>
              </div>

             <label for="message-text" class="col-form-label">Social Media:</label>
             <div class="form-group">
             <div class="input-group">
               <span class="input-group-addon"><i class="fab fa-twitter"></i></span>
               <input type="text" class="form-control" name="twitter" @if($user->twitter!="") value="{{$user->twitter}}" @else  placeholder="@" @endif>
             </div>
            </div>

            <div class="form-group">
             <div class="input-group">
               <span class="input-group-addon"><i class="fab fa-github"></i></span>
               <input type="text" class="form-control" name="github" @if($user->github!="") value="{{$user->github}}" @else  placeholder="Github" @endif>
             </div>
             </div>
             <div class="form-group">
             <div class="input-group">
               <span class="input-group-addon"><i class="fab fa-dribbble"></i></span>
               <input type="text" class="form-control" name="dribbble" @if($user->dribbble!="") value="{{$user->dribbble}}" @else  placeholder="Dribbble" @endif>
             </div>
             </div>
             <div class="form-group">
             <div class="input-group">
               <span class="input-group-addon"><i class="fas fa-globe"></i></span>
               <input type="text" class="form-control" name="website" @if($user->website!="") value="{{$user->website}}" @else  placeholder="www.yourwebsite.com" @endif>
             </div>
           </div>
           <input type="hidden" name="user" value="{{ $user->username }}">

           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Save changes</button>
           </div>
           {!! Form::close() !!}

            </div>

          </div>
        </div>
      </div>
      @endauth
  </div>
</div>
  @endsection
