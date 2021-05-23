<a onclick="deleteConfirmation({{$id}})" class="btn btn-danger">
    {{ __('common.destroy') }}
</a>
<form action="{{ route('categories.destroy' , $id) }}" class="deleted_form_{{$id}}" method="post">
    @csrf
    @method('DELETE')
</form>
