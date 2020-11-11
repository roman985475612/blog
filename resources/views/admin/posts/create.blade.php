@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добавить пост
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      {!! Form::open(['route' => 'posts.store', 'files' => true]) !!}
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Добавляем пост</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('title', 'Название') }}
              {{ Form::text('title', old('title'), [
                'class' => 'form-control', 
                'placeholder' => 'Название',
                'autofocus',
              ]) }}
            </div>
            <div class="form-group">
              {{ Form::label('image', 'Лицевая картинка') }}
              {{ Form::file('image') }}
            </div>
            <div class="form-group">
              {{ Form::label('category_id', 'Категория') }}
              {{ Form::select('category_id', $categories, null, [
                'placeholder' => 'Выберите категорию',
                'class' => 'form-control select2',
              ]) }}
            </div>
            <div class="form-group">
              {{ Form::label('tag_ids', 'Теги') }}
              {{ Form::select('tag_ids', $tags, null, [
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
                {{ Form::text('date', old('date'), [
                  'id' => 'datepicker',
                  'class' => 'form-control pull-right',
                ]) }}
              </div>
            </div>
            <div class="form-check">
              {{ Form::checkbox('is_featured', 'value', true, ['class' => 'form-check-input minimal']) }}
              {{ Form::label('is_featured', 'Рекомендовать', ['class' => 'form-check-label']) }}
            </div>
            <div class="form-check">
              {{ Form::checkbox('status', 'value', true, ['class' => 'form-check-input minimal']) }}
              {{ Form::label('status', 'Черновик', ['class' => 'form-check-label']) }}
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              {{ Form::label('content', 'Полный текст') }}
              {{ Form::textarea('content', old('content'), [
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
          {{ Form::submit('Добавить', ['class' => 'btn btn-success pull-right']) }}
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      {!! Form::close() !!}
    </section>
    <!-- /.content -->
  </div>
@endsection
