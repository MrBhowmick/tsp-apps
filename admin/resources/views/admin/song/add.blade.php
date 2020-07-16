@extends('admin.app.app')


@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Song Add</li>
  </ol>

  <!-- Page Content -->
  <h1>ADD SONG</h1>
  <hr>
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Song Add</div>
      <div class="card-body">
        <!-- data added success message -->
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        <!-- validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('songStore') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="name" id="name" class="form-control" placeholder="Song Name" required="required" autofocus="autofocus">
              <label for="name">Song Name</label>
            </div> 
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <b class="text-left">Main Category</b>
              <select name="maincategory" id="maincategory" class="form-control">
                  <option selected="true" disabled="true">------ SELECT ------</option>
                @foreach($maincategories as $maincategory)
                  <option value="{{$maincategory->id}}">{{$maincategory->name}}</option>
                @endforeach
              </select>
            </div> 
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <b class="text-left">Sub Category</b>
              <select name="subcategory" id="subcategory" class="form-control">
                  <option selected="true" disabled="true">------ SELECT ------</option>
                @foreach($subcategories as $subcategory)
                  <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                @endforeach
              </select>
            </div> 
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="file" name="image" id="image" class="form-control" placeholder="Image" required="required">
              <label for="image">Image</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <b class="text-left">Song Tags</b>
              <input id="form-tags-4" name="tags" type="text" value="" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <b class="text-left">Song URL</b>
              <input class="form-control" name="song_url" type="text" value="">
            </div>
          </div>
          
          
          <input type="submit" name="submit" value="ADD" class="btn btn-primary btn-block">
        </form>
        
      </div>
    </div>
  </div>


</div>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
      var tags = '{!! $tags !!}';
      tags = JSON.parse(tags);
      $('#form-tags-4').tagsInput({
          'unique': true,
          'minChars': 2,
          'autocomplete': {
            source: tags
          } 
        });
    });
  </script>
@endsection