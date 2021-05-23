<a href="{{ route('vendors.edit' , $id) }}" class="btn btn-info">
    <i class="fas fa-edit"></i>
</a>
<a onclick="deleteConfirmation({{$id}})" class="btn btn-danger">
    <i class="far fa-trash-alt"></i>
</a>
<form action="{{ route('vendors.destroy' , $id) }}" class="deleted_form_{{$id}}" method="post">
    @csrf
    @method('DELETE')
</form>
