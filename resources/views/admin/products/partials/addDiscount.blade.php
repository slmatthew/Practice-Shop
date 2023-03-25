<div class="modal fade" id="{{ "m-ad-{$product->id}" }}" tabindex="-1" aria-labelledby="{{ "madL{$product->id}" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "madL{$product->id}" }}">Добавить скидку</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.product.discount.add', $product->id) }}">

                @csrf
                @method('PUT')

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="pType">Тип скидки</label>
                        <select name="type" class="form-select" id="pType">
                            <option value="price" selected>Новая цена</option>
{{--                            <option value="percent">В процентах</option>--}}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pAmount">Скидка</label>
                        <input name="amount" type="number" class="form-control" value="{{ $product->price - ($product->price / 2) }}" id="pAmount" step=".01" required>
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
