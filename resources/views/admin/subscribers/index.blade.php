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
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>
  
    <!-- Main content -->
    <section class="content">
  
      @include('admin.errors')

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
                    <th>Email</th>
                    <th>token</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($subs as $sub)
                    <tr>
                      <td>{{ $sub->id }}</td>
                      <td>{{ $sub->email }}</td>
                      <td>{{ $sub->token }}</td>
                      <td>{{ $sub->created_at }}</td>
                      <td>
                        <div class="btn-group btn-group-sm">
                          <button 
                            data-id="{{ $sub->id }}" 
                            data-route="{{ route('subscribes.destroy', ['subscribe' => $sub->id]) }}" 
                            data-action="confirmDelete" 
                            type="button" 
                            class="btn btn-danger"
                          >
                            Delete
                          </button> 
                        </div>
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
  
<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
            </div>
            <div class="modal-body">
                Deleting #   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="actionBtn" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<form id="actionForm" action="" method="POST">
  @csrf
  <input type="hidden" name="_method" value="DELETE">
</form>

@endsection

@section('script')
<script>
  
  document.querySelector('.btn-group').addEventListener('click', event => {
    event.preventDefault()
    if (event.target.dataset.action == 'confirmDelete') {
        let id = event.target.dataset.id
        let route = event.target.dataset.route

        document.querySelector('.modal-title').textContent = `Удаление подписчика №${id}`
        document.querySelector('.modal-body').textContent = `Вы уверены, что хотите удалить подписчика №${id}?`
        
        let btn = document.querySelector('#actionBtn')
        if (!btn.classList.contains('btn-danger')) {
          btn.classList.add('btn-danger')
        }
        btn.textContent = 'Удалить'
        
        $('#adminModal').modal()

        document.querySelector('#actionBtn').addEventListener('click', event => {
          let form = document.querySelector('#actionForm')
          form.setAttribute('action', route)
          form.submit()  
        })
   }
  }) 
</script>
@endsection