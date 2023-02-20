

<form id="delete_form_{{$form_id ?? ''}}" method="POST" action="{{ route($route ?? '/', $data ?? '') }}" style="display: inline-block;vertical-align: middle;">
    @csrf
    {{ method_field('DELETE') }}
	<button title="Delete record" type="button" onclick="deleteConfirm('delete_form_{{$form_id}}')"  class="btn btn-danger btn-sm btn-bg-white del_pl" style="color: #e75b5b;"><i class="fa fa-trash-alt"></i></button>
    
</form>