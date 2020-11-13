@extends('admin.layout')
  
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{ route('users.create') }}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>E-mail</th>
                    <th>Аватар</th>
                    <th>Действия</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td><img class="img-admin thumbnail" src="{{ $user->getAvatar() }}"></td>
                      <td>
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="fa fa-pencil"></a> 
                        @include('admin.inc._modalDelete', ['id' => $user->id, 'route' => 'users.destroy']) 
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>  
@endsection

@section('script')
  <script>
    $(function () {
      $("#example1").DataTable();

      $('.deleteCategory').click(function(){
        if( confirm('Are you sure?') )
        {
          const id = $(this).attr('id');
          $('#formDelete' + id).submit();
        }
      });
    });
  </script>    
@endsection
