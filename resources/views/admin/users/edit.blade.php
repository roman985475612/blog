@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Редактировать пользователя
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      {!! Form::open(['route' => ['users.update', $user->id], 'files' => true, 'method' => 'put']) !!}
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Редактируем пользователя</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('name', 'Имя') }}
              {{ Form::text('name', $user->name, [
                'class' => 'form-control', 
                'placeholder' => 'Имя',
                'autofocus',
              ]) }}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'E-mail') }}
              {{ Form::email('email', $user->email, [
                'class' => 'form-control', 
                'placeholder' => 'E-mail',
              ]) }}
            </div>
            <div class="form-group">
              {{ Form::label('password', 'Пароль') }}
              {{ Form::password('password', [
                'class' => 'form-control', 
                'placeholder' => 'пароль',
              ]) }}
            </div>
            <div class="form-group">
              {{ Form::label('avatar', 'Аватар') }}
              {{ Form::file('avatar') }}
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

@section('script')
  <script>
    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();
      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      });
      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      });
    });
  </script>
@endsection
