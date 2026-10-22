@props(['action', 'message' => 'Are you sure you want to delete this record? This cannot be undone.'])
<form action="{{ $action }}" method="POST" class="d-inline"
      onsubmit="return confirm(@js($message));">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
</form>
