@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li style="margin-left:20px">{{ $error }}</li>
        @endforeach
    </ul>
@endif
