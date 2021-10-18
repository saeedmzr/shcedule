<!-- Navbar -->


<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

</nav>


<!-- /.navbar -->





<!-- Main Sidebar Container -->


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <div class="name__user">
            <img src="{{asset('AdminLTE/dist/img/userimg.png')}}" alt="">
            <span class="brand-text font-weight-light"> Hi {{auth()->user()->name}}</span>
        </div>
        <!--name__user-->
    </a>



    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item"><a href="{{route('task.index')}}" class="nav-link">
                        <p>
                            Tasks
                        </p>
                    </a>

                </li>
                <li class="nav-item"><a href="{{route('user.index')}}" class="nav-link">
                        <p>
                            Users
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a id='logout' href="{{route('logout')}}" class="nav-link">
                        <p><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>