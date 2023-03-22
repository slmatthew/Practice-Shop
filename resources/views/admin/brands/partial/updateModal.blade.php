<div class="modal fade" id="{{ "mBrandUpd{$brand->id}" }}" tabindex="-1" aria-labelledby="{{ "mBrandUpdL{$brand->id}" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "mBrandUpdL{$brand->id}" }}">{{ $brand->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.brand.update') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <input type="hidden" name="id" value="{{ $brand->id }}" />

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="pName">Название</label>
                        <input name="name" type="text" class="form-control" placeholder="Apple" value="{{ $brand->name }}" id="pName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pSlug">ЧПУ</label>
                        <input name="slug" type="text" class="form-control" placeholder="apple" value="{{ $brand->slug ?? '' }}" id="pSlug" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pDesc">Описание</label>
                        <textarea name="description" style="resize: none" class="form-control" placeholder="Это мы, да-да" rows="3" id="pDesc">{{ $brand->description }}</textarea>
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
