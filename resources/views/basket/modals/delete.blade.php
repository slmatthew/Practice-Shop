<div class="modal fade" id="modalDelete{{ $item['product']['id'] }}" tabindex="-1" aria-labelledby="MDHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="MDHeader">{{ $item['product']['name'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('basket.deleteProduct') }}">
                @csrf
                @method('DELETE')

                <input type="hidden" name="product_id" value="{{ $item['product']['id'] }}" />

                <div class="modal-body">
                    Вы действительно хотите удалить этот товар из корзины?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>
