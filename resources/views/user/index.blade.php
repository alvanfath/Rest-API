<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
@include('layout.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
    @include('layout.sidebar')
  <!-- Main Sidebar Container -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          <button type="button" class="btn btn-info float-sm-right" data-bs-toggle="modal" data-bs-target="#add">
          <i class="fa-solid fa-plus"></i>
            Add Data
          </button>

          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

        <!-- Add Data -->
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLabel">Add Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('users.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namadepan" class="form-label">First Name</label>
                            <input type="text" name="nama_depan" class="form-control" id="namadepan">
                        </div>
                        <div class="mb-3">
                            <label for="namabelakang" class="form-label">Last Name</label>
                            <input type="text" name="nama_belakang" class="form-control" id="namabelakang" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- End Add Data -->

         <!-- edit Data -->
         <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ url('update') }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="namadepan" class="form-label">First Name</label>
                            <input type="text" name="nama_depan" class="form-control" id="nama_depan">
                        </div>
                        <div class="mb-3">
                            <label for="namabelakang" class="form-label">Last Name</label>
                            <input type="text" name="nama_belakang" class="form-control" id="nama_belakang" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- End edit Data -->


      <div class="container-fluid">
        <div class="row">
            <table id="table" class="table table-dark table-striped">
                <tr>
                    <th>No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Action</th>
                    <th>Full Name</th>
                </tr>
                @forelse($users['data'] as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user['firstName'] }}</td>
                    <td>{{ $user['lastName'] }}</td>
                    <td>{{ $user['firstName'] }} {{ $user['lastName'] }}</td>
                    <td>
                            <button type="button" class="text-warning btn btn-link"  onclick="editdata('{{ $user['id'] }}')"><i class="fa fa-fw fa-edit"></i></button> 
                            <a href="destroy/{{$user['id']}}" class="text-danger btn btn-link" onclick="return confirm('are you sure to delete this data?')" ><i class="fa fa-fw fa-trash"></i></a>
                        
                    </td>
                </tr>
                @empty
                    <tr><td colspan="6" align="center">No Record(s) Found!</td></tr>
                @endforelse
            </table>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Ho'oh
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

@include('layout.js')
@include('sweetalert::alert')
<script>
    function editdata(id){
       $.ajax({
           url:"/users/" + id,
           data:{
               _token:'{{csrf_token()}}'
           },
           type: "GET",
           success:(response)=>{
               console.log(response)
               $('#edit').modal('show')
               $('#id').val(response.id)
               $('#nama_depan').val(response.firstName)
               $('#nama_belakang').val(response.lastName)
               $('#editLabel').text('Edit Data')
           },
           error:(response)=>{
               console.log(response)
           }
       })
    }
</script>
</body>
</html>
