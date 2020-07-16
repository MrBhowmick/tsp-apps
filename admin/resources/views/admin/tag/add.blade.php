@extends('admin.app.app')


@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Tag Add</li>
  </ol>

  <!-- Page Content -->
  <h1>ADD TAG</h1>
  <hr>
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Tag Add</div>
      <div class="card-body">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <form action="{{ route('tagStore') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="name" id="name" class="form-control" placeholder="Tag Name" required="required" autofocus="autofocus">
              <label for="name">Tag Name</label>
            </div> 
          </div>

          <input type="submit" name="submit" value="ADD" class="btn btn-primary btn-block">
        </form>
        
      </div>
    </div>
  </div>


</div>
@endsection