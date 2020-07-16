@extends('admin.app.app')


@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Sub Category Add</li>
  </ol>

  <!-- Page Content -->
  <h1>ADD SUB CATEGORY</h1>
  <hr>
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Sub Category Add</div>
      <div class="card-body">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <form action="{{ route('subCategoryStore') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="name" id="name" class="form-control" placeholder="Sub Category Name" required="required" autofocus="autofocus">
              <label for="name">Sub Category Name</label>
            </div> 
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="file" name="image" id="image" class="form-control" placeholder="Image" required="required">
              <label for="image">Image</label>
            </div>
          </div>
          
          
          <input type="submit" name="submit" value="ADD" class="btn btn-primary btn-block">
        </form>
        
      </div>
    </div>
  </div>


</div>
@endsection