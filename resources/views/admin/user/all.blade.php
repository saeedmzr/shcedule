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
</script>
@endsection
@section('content')


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Users</h1>
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
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Tasks</th>
              </tr>
            </thead>
            <tbody>
              @foreach( $users as $key => $user )
              <tr>
                <td> {{$user->name}} </td>
                <td> {{$user->email}} </td>
                <td> {{$user->created_at}} </td>
                <td>
                  <div class="btn-group ">
                    <a class="btn btn-success" href={{route('task.index',['user_id'=>$user->id])}}>Click</a>
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