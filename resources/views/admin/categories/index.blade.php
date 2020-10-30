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
                <a href="{{ route('categories.create') }}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Действия</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                    <tr>
                      <td>{{ $category->id }}</td>
                      <td>{{ $category->title }}</td>
                      <td>
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="fa fa-pencil"></a> 
                        <a class="fa fa-remove deleteCategory" href="javascript:void(0);" id="{{$category->id}}"></a>
                        {{ Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete', 'id' => 'formDelete'.$category->id]) }}
                        {{ Form::close() }}
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
