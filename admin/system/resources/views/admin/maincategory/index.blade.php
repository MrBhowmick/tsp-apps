@extends('admin.app.app')


@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Main Category List</li>
  </ol>

  <!-- Page Content -->
  <h1>MAIN CATEGORY LIST</h1>
  <hr>
  @if (\Session::has('success'))
      <div class="alert alert-success">
          <ul>
              <li>{!! \Session::get('success') !!}</li>
          </ul>
      </div>
  @endif
  <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        List</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($maincategories as $maincategory)
              <tr>
                <td><img src="{{ asset('images/maincategory') . '/'.$maincategory->image }}" class="img-responsive img-thumbnail" style="max-width: 100px;"></td>
                <td>{{$maincategory->name}}</td>
                <td>
                  <a href="javascript::void(0)" id="edit" data-id="{{ $maincategory->id }}" data-name="{{ $maincategory->name }}" data-image="{{ asset('images/maincategory') . '/'.$maincategory->image }}" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal" data-formUrl="{{route('mainCategoryUpdate',$maincategory->id)}}">EDIT</a>
                  
                  <a href="javascript::void(0)" id="delete" data-id="{{ $maincategory->id }}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal" data-formUrl="{{route('mainCategoryDelete',$maincategory->id)}}">DELETE</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>


</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal Header</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection


@section('script')
<script>
  $(document).ready(function(){
    // edit
    $('a#edit').on('click',function(){
      var id = $(this).attr('data-id');
      var name = $(this).attr('data-name');
      var image = $(this).attr('data-image');
      var formUrl = $(this).attr('data-formUrl');
      $('.modal-title').text('EDIT');
      $('.modal-body').html('');
      $('.modal-body').html('<form action="'+formUrl+'" method="post" enctype="multipart/form-data">@csrf<input type="text" name="name" value="'+name+'" placeholder="Name" class="form-control"><img src="'+image+'" class="img-thumbnail" style="max-width: 100px;"><br>Change Image<input type="file" name="image" class="form-control"><br><input type="submit" name="submit" value="UPDATE" class="form-control btn btn-success"></form>');
    });

    // Delete
    $('a#delete').on('click',function(){
      var id = $(this).attr('data-id');
      var formUrl = $(this).attr('data-formUrl');
      $('.modal-title').text('Do you really want to delete?');
      $('.modal-body').html('<button type="button" class="btn btn-warning" data-dismiss="modal">No</button><a href="'+formUrl+'" class="btn btn-danger pull-right">Yes</a>');
    });
  });
</script>
@endsection