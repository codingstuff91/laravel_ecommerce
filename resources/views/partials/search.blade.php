<form action="{{ route('products.search') }}" class="d-flex">
    <div class="form-group mt-0 mb-0 mr-2">
        <input type="text" name="query" class="form-control" value="{{ request()->input('query') }}">
    </div>

    <input type="submit" value="Rechercher" class="btn btn-sm btn-info">
</form>