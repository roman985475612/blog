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
                    <th>Название</th>
                    <th>Категория</th>
                    <th>Теги</th>
                    <th>Картинка</th>
                    <th>Действия</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($posts as $post)
                    <tr>
                      <td>{{ $post->id }}</td>
                      <td>{{ $post->title }}</td>
                      <td>
                        @if ($post->getCategoryTitle())
                          {{ $post->getCategoryTitle() }}    
                        @else
                          Нет категории
                        @endif
                      </td>
                      <td>
                        @forelse ($post->getTagsTitle() as $tagTitle)
                          <span class="label label-primary">{{ $tagTitle }}</span></a>
                        @empty
                          Нет тегов
                        @endforelse
                      </td>
                      <td><img src="{{ $post->getImage() }}" height="auto" width="100"></td>
                      <td>
                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="fa fa-pencil"></a> 
                        @include('admin.inc._modalDelete', ['id' => $post->id, 'route' => 'posts.destroy']) 
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
    });
  </script>    
@endsection
