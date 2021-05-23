<a href="{{ route('apps.show' , $id) }}" class="btn btn-info">
    <i class="fas fa-eye"></i>
</a>
<a onclick="deleteConfirmation({{$id}})" class="btn btn-danger">
    <i class="far fa-trash-alt"></i>
</a>
<form action="{{ route('apps.destroy' , $id) }}" class="deleted_form_{{$id}}" method="post">
    @csrf
    @method('DELETE')
</form>
