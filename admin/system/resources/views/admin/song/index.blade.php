@extends('admin.app.app')


@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Song List</li>
  </ol>

  <!-- Page Content -->
  <h1>SONG LIST</h1>
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
                <th>Song</th>
                <th>Name</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Image</th>
                <th>Song</th>
                <th>Name</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($songs as $song)
              <tr>
                <td><img src="{{ asset('images/song') . '/'.$song->image }}" class="img-responsive img-thumbnail" style="max-width: 100px;"></td>

                <td>
                  <audio controls>
                    <source src="{{$song->song_url}}" type="audio/mpeg">
                    Your browser does not support the audio tag.
                  </audio>
                </td>

                <td>{{$song->name}}</td>
                <td>{{$song->maincategory->name}}</td>
                <td>

                  <a href="{{ route('songEdit',$song->id) }}" id="edit" data-id="{{ $song->id }}" data-name="{{ $song->name }}" data-image="{{ asset('images/song') . '/'.$song->image }}" class="btn btn-sm btn-warning" data-formUrl="{{route('songUpdate',$song->id)}}">VIEW & EDIT</a>
                  
                  <a href="javascript::void(0)" id="delete" data-id="{{ $song->id }}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal" data-formUrl="{{route('songDelete',$song->id)}}">DELETE</a>
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