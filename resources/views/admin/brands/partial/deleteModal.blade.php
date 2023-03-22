<div class="modal fade" id="{{ "mBrandDel{$brand->id}" }}" tabindex="-1" aria-labelledby="{{ "mBrandDelL{$brand->id}" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "mBrandDelL{$brand->id}" }}">{{ $brand->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.brand.delete') }}">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="{{ $brand->id }}" />

                <div class="modal-body">
                    Вы действительно хотите удалить бренд #{{ $brand->id }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>
