<div class="modal fade" id="{{ "MUP{$id}" }}" tabindex="-1" aria-labelledby="MUPLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="MUPLabel">{{ $name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.category.update') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <input type="hidden" name="id" value="{{ $id }}" />

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="pName">Название</label>
                        <input name="name" type="text" class="form-control" placeholder="Смартфоны" value="{{ $name }}" id="pName" required>
                    </div>
                    <div>
                        <label class="form-label" for="pImage">Изображение</label>
                        <input name="image" type="file" class="form-control" id="pImage">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
