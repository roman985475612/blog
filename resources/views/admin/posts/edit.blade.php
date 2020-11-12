@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Редактировать пост
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      {!! Form::open([
        'route'  => ['posts.update', $post->id], 
        'files'  => true,
        'method' => 'put'
      ]) !!}
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Редактуруем пост</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('title', 'Название') }}
              {{ Form::text('title', $post->title, [
                'class' => 'form-control', 
                'placeholder' => 'Название',
                'autofocus',
              ]) }}
            </div>
            <div class="form-group">
              {{ Form::label('image', 'Лицевая картинка') }}
              <img class="img-admin thumbnail" src="{{ $post->getImage() }}">
              {{ Form::file('image') }}
            </div>
            <div class="form-group">
              {{ Form::label('category_id', 'Категория') }}
              {{ Form::select('category_id', $categories, $post->category_id, [
                'placeholder' => 'Выберите категорию',
                'class' => 'form-control select2',
              ]) }}
            </div>
            <div class="form-group">
              {{ Form::label('tags', 'Теги') }}
              {{ Form::select('tags[]', $tags, $post->getTagsId(), [
                'multiple' => 'multiple',
                'data-placeholder' => 'Выберите теги',
                'class' => 'form-control select2',
              ]) }}
            </div>
            <div class="form-group">
              {{ Form::label('date', 'Дата:') }}
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                {{ Form::text('date', $post->date, [
                  'id' => 'datepicker',
                  'class' => 'form-control pull-right',
                ]) }}
              </div>
            </div>
            <div class="form-check">
              {{ Form::checkbox('is_featured', '1', $post->is_featured, ['class' => 'form-check-input minimal']) }}
              {{ Form::label('is_featured', 'Рекомендовать', ['class' => 'form-check-label']) }}
            </div>
            <div class="form-check">
              {{ Form::checkbox('status', '1', $post->status, ['class' => 'form-check-input minimal']) }}
              {{ Form::label('status', 'Черновик', ['class' => 'form-check-label']) }}
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              {{ Form::label('content', 'Полный текст') }}
              {{ Form::textarea('content', $post->content, [
                'class' => 'form-control',
                'col' => '30',
                'row' => '10',
              ]) }}
            </div>
          </div>
      </div>
      
        <!-- /.box-body -->
        <div class="box-footer">
          {{ Form::submit('Назад', ['class' => 'btn btn-default']) }}
          {{ Form::submit('Сохранить', ['class' => 'btn btn-success pull-right']) }}
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      {!! Form::close() !!}
    </section>
    <!-- /.content -->
  </div>
@endsection
