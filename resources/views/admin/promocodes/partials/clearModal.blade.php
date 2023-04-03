<div class="modal fade" id="mTruncatePC" tabindex="-1" aria-labelledby="mTruncatePCH" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="mTruncatePCH">Удалить промокоды</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.promocodes.clear') }}">

                @csrf
                @method('DELETE')

                <div class="modal-body">
                    Вы действительно хотите удалить все промокоды?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>
