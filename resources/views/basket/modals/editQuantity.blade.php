<div class="modal fade" id="modalQuantity{{ $item['id'] }}" tabindex="-1" aria-labelledby="MQHeader{{ $item['id'] }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="MQHeader{{ $item['id'] }}">{{ $item['product']['name'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('basket.editProduct') }}">
                @csrf
                @method('POST')

                <input type="hidden" name="id" value="{{ $item['id'] }}" />
                <input type="hidden" name="product_id" value="{{ $item['product']['id'] }}" />

                <div class="modal-body">
                    <label class="form-label" for="pQuantity">Количество</label>
                    <input name="quantity" type="number" class="form-control" placeholder="1" value="{{ $item['quantity'] }}" id="pQuantity" required>

                    @if(!$item->isPriceActual())
                        <div class="alert alert-warning mt-3" role="alert">
                            <h4 class="alert-heading">Обратите внимание!</h4>
                            Цена на этот товар изменилась. Чтобы купить товар по старой цене, нажмите «Отмена»
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-{{ $item->isPriceActual() ? 'secondary' : 'danger' }}" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
