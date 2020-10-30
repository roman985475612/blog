@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добавить категорию
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      {!! Form::open(['route' => 'categories.store']) !!}
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Добавляем категорию</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('title', 'Название') }}
              {{ Form::text('title', '', ['class' => 'form-control'], $attributes = ['placeholder' => 'Название категории']) }}
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
