<div class="modal fade" id="{{ "mdp{$id}" }}" tabindex="-1" aria-labelledby="{{ "mdp{$id}Label" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "mdp{$id}Label" }}">{{ $product['name'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.product.delete') }}">
                @csrf

                <input type="hidden" name="id" value="{{ $product['id'] }}" />

                <div class="modal-body">
                    Вы действительно хотите удалить товар #{{ $product['id'] }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>
