@extends('masters.admin')
@section('script')
<script>
  $('#table1').DataTable({
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  "responsive": true,
  });

$(document).on('click','.update-status',function(evt){
  evt.preventDefault();var element = $(this);
  var id = $(this).attr('data-id');
  var action = "{{route('updateTaskStatus')}}";
  $.ajax({
  url: action,
  dataType:'JSON',
  method: 'POST',
  data: {
    id : id,
    _token : "{{csrf_token() }}"
  }
  }).done (function(response)
    {
    if(response)
    {
      $(element).removeClass('btn-danger');
      $(element).addClass('btn-success');
    }else
    {
      $(element).addClass('btn-danger');
      $(element).removeClass('btn-success');
    }
  });
});
</script>
@endsection
@section('content')


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tasks</h1>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="table1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>User</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach( $tasks as $key => $task )
              <tr>
                <td> {{$task->user->email}} </td>
                <td> {{$task->title}} </td>
                <td> {{$task->description}} </td>
                <td> {{$task->reserved_at}} </td>
                <td>
                  <div class="btn-group ">
                    <button class="update-status btn btn-{{$task->status ? 'success' : 'danger' }}"
                      data-id='{{$task->id}}'>Confirmation</button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
</section>


@endsection