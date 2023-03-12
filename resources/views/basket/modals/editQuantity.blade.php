<div class="modal fade" id="modalQuantity{{ $item['product']['id'] }}" tabindex="-1" aria-labelledby="MQHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="MQHeader">{{ $item['product']['name'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('basket.editProduct') }}">
                @csrf
                @method('POST')

                <input type="hidden" name="product_id" value="{{ $item['product']['id'] }}" />

                <div class="modal-body">
                    <label class="form-label" for="pQuantity">Количество</label>
                    <input name="quantity" type="number" class="form-control" placeholder="1" value="{{ $item['quantity'] }}" id="pQuantity" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
