@extends('dashboard.admin.layouts.app')

@section('page_title', 'Spotlights')

@section('head_style')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('admin_dashboard/assets/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('admin_dashboard/assets/css/responsive.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('admin_dashboard/assets/css/buttons.bootstrap4.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Hi Admin Welcome Back</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Spotlights</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- Messages -->
          @include('dashboard.admin.includes.messages')

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage Spotlight</h3>
              <div class="card-tools">
                <a href="{{ url('/admin/spotlight/add') }}" class="btn btn-primary">
                  <i class="fa fa-user mr-2"></i> Add new spotlight
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <!--<th>Description</th>-->
                    <!--<th>Status</th>-->
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($spotlights as $key=>$spotlight)
                  <tr>
                    <td>{{ ++$key }}. </td>
                    <td>{{ $spotlight->name }}</td>
                    <td><img src="../storage/spotlights/{{ $spotlight->image }}" width="100px" height="50px"></td>
                    <td style="width: 11rem">
                      <a href="{{ url('/admin/spotlight/edit/'.$spotlight->id) }}" class="btn btn-info btn-sm"><i
                          class="fas fa-edit mr-2"></i> Edit</a>

                      <a href="{{ url('/admin/spotlight/delete/'.$spotlight->id) }}" class="btn btn-danger btn-sm"><i
                          class="fa fa-trash mr-2"></i> Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection

@section('bottom_script')
<script src="{{ asset('admin_dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/js/responsive.bootstrap4.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    });
  });
</script>
@endsection