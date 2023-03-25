<div class="modal fade" id="{{ "mdpc{$id}" }}" tabindex="-1" aria-labelledby="{{ "mdpc{$id}Label" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @php
                $data = $product ?? $category;
            @endphp
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "mdpc{$id}Label" }}">{{ $data['name'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ $action }}">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="{{ $data['id'] }}" />

                <div class="modal-body">
                    Вы действительно хотите удалить {{ isset($product) ? 'товар' : 'категорию' }} #{{ $data['id'] }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>
