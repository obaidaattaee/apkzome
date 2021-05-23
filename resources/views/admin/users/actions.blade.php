<a href="{{ route('users.change-password' , $id) }}" class="btn btn-info">
    {{ __('auth.change_password') }}
</a>
<a href="{{ route('users.edit' , $id) }}" class="btn btn-info">
    {{ __('common.edit') }}
</a>
<a onclick="deleteConfirmation({{$id}})" class="btn btn-danger">
    {{ __('common.destroy') }}
</a>
<form action="{{ route('users.destroy' , $id) }}" class="deleted_form_{{$id}}" method="post">
    @csrf
    @method('DELETE')
</form>
