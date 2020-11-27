@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li style="margin-left:20px">{{ $error }}</li>
        @endforeach
    </ul>
@endif

@if (session('status'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Ошибка!</strong> {{ session('status') }}
    </div>
@endif

