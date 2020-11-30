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
                <a href="{{ route('posts.create') }}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Текст</th>
                    <th>Статья</th>
                    <th>Пользователь</th>
                    <th>Статус</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($comments as $comment)
                    <tr>
                      <td>{{ $comment->id }}</td>
                      <td>{!! $comment->text !!}</td>
                      <td>{{ $comment->post->title }}</td>
                      <td>{{ $comment->author->name }}</td>
                      <td>
                        @if ($comment->status)
                          <button data-id="{{ $comment->id }}" data-type="status" class="btn btn-sm btn-success">allowed</button></a>
                        @else
                          <button data-id="{{ $comment->id }}" data-type="status" class="btn btn-sm btn-danger">deny</button></a>
                        @endif
                      </td>
                      <td>{{ $comment->created_at }}</td>
                      <td>
                        <a href="{{ route('posts.edit', ['post' => $comment->id]) }}" class="fa fa-pencil"></a> 
                        @include('admin.inc._modalDelete', ['id' => $comment->id, 'route' => 'comments.destroy']) 
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
