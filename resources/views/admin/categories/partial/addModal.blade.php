<div class="modal fade" id="modalAddCtg" tabindex="-1" aria-labelledby="modalAddCtgLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAddCtgLabel">Новая категория</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.category.add') }}">
                @csrf

                <div class="modal-body">
                    <label class="form-label" for="pName">Название</label>
                    <input name="name" type="text" class="form-control" placeholder="Смартфоны" value="" id="pName" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
