<a href="#!" class="fa fa-remove modal-delete-btn" id="{{ $id }}"></a>

<div class="modal fade" id="modalDelete{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
            </div>
            <div class="modal-body">
                Deleting #{{ $id }}    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger submit-delete-btn" data-dismiss="modal" id="{{ $id }}">Delete</button>
            </div>
        </div>
    </div>
</div>

{{ Form::open(['route' => [$route, $id], 'method' => 'delete', 'id' => 'formDelete'.$id]) }}
{{ Form::close() }}
