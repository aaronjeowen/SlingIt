@extends('layouts.app')

@section('content')
<div class="container">

  <h1>Submit Content</h1>

  {!! Form::open(['url' => 'submit/submit','files'=>'true','class'=>'submitForm']) !!}
  <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
    <div class="form-group">
      <h3>Post Title</h3>
      <!-- <label for="formTitle">Title</label> -->
      {{Form::text('title', '',['class'=> 'form-control','placeholder'=>'Enter title','id'=>'formTitle'])}}
      <small id="dHelpBlock" class="form-text text-muted">
          Give a catchy title to your post
      </small>

      @if ($errors->has('title'))
          <span class="help-block server-error">
              <strong>{{ $errors->first('title') }}</strong>
          </span>
      @endif
    </div>

    <div class="form-group">
      <!-- {{Form::label('tags', 'Type')}} -->
      <h3>Type</h3>
      {{Form::select('tags', ['Picture' => 'Picture', 'Code' => 'Code'], null, ['placeholder' => 'Pick one','id'=>'forming', 'required'=>''])}}
      @if ($errors->has('tags'))
          <span class="help-block server-error">
              <strong>{{ $errors->first('tags') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group newform" id="hiddenTag" >
      {{Form::label('code', 'Code Type')}}
      {{Form::select('code', ['HTML' => 'HTML', 'CSS' => 'CSS','JAVASCRIPT'=>'JavaScript','PHP'=>'PHP'], null, ['placeholder' => 'Pick one','id'=>'hiddenValue'])}}
      @if ($errors->has('code'))
          <span class="help-block server-error">
              <strong>{{ $errors->first('code') }}</strong>
          </span>
      @endif
    </div>

    <div class="form-group">
      <h3>File</h3>
      <!-- {{Form::label('file', 'File')}} -->
      <p id="imageTag">For code submissions a placeholder image will be used</p>
      {{Form::file('file',['required'=>''])}}
      @if ($errors->has('file'))
          <span class="help-block server-error">
              <strong>{{ $errors->first('file') }}</strong>
          </span>
      @endif
    </div>


    <div class="form-group">
      <h3>Description</h3>
      <textarea id="summernote" name="description"></textarea>
      @if ($errors->has('editordata'))
          <span class="help-block server-error">
              <strong>{{ $errors->first('editordata') }}</strong>
          </span>
      @endif
    </div>
    <div>
      {{Form::submit('Submit',['class'=> 'btn btn-primary'])}}
 </div>
  {!! Form::close() !!}
</div>

<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
              <h2>Upload files under MIT License</h2>
              By clicking submit you confirm that t

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="submit" class="btn btn-success success">Submit</a>
            </div>
        </div>
    </div>
</div>

  <script>
  $(document).ready(function() {
      $('#summernote').summernote();
  });
</script>
@endsection
