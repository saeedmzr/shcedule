@extends('masters.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{\App\Models\Task::all()->count()}}</h3>

                        <p>All Tasks</p>

                    </div>

                    <div class="icon">

                        <i class="ion ion-bag"></i>

                    </div>

                    <a href="{{route('task.index')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">


                <!-- small box -->


                <div class="small-box bg-danger">


                    <div class="inner">


                        <h3>{{\App\Models\User::all()->count()}}</h3>





                        <p>Users</p>


                    </div>


                    <div class="icon">


                        <i class="ion ion-pie-graph"></i>


                    </div>


                    <a href="{{route('user.index')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>


                </div>


            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection