<div class="modal fade" id="{{ "mPCDel{$promocode->id}" }}" tabindex="-1" aria-labelledby="{{ "mPCDelH{$promocode->id}" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "mPCDelH{$promocode->id}" }}">{{ $promocode->promocode }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.promocodes.delete', $promocode) }}">

                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="{{ $promocode->id }}" />

                <div class="modal-body">
                    Вы действительно хотите удалить промокод {{ $promocode->promocode }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>
