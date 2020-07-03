@extends('admin.common.index')
@section('page_title')
  Pains
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>List Of Pains</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Pains</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{route('add_pain')}}" class="btn bg-gradient-success">Add New</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover datatable">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                @foreach($pains as $pain)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$pain->pain_name}}</td>
                  <td>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      Actions
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="{{route('edit_pain', $pain->pain_id)}}">Edit</a>
                      <button class="dropdown-item alerts" data-url="{{asset('admin/delete_pain')}}/" data-table="datatable" data-id="{{ $pain->pain_id }}">Delete</button>
                    </div>
                    
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection