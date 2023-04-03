<div class="modal fade" id="{{ "m-cd-{$product->id}" }}" tabindex="-1" aria-labelledby="{{ "mcdL{$product->id}" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "mcdL{$product->id}" }}">Удалить все скидки?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.product.discount.clear', $product->id) }}">

                @csrf
                @method('DELETE')

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="modal-body">
                    Вы действительно хотите удалить все скидки для этого товара?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-outline-danger">Очистить</button>
                </div>
            </form>
        </div>
    </div>
</div>
