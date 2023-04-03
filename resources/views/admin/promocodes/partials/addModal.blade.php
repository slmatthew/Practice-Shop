<div class="modal fade" id="modalAddPC" tabindex="-1" aria-labelledby="modalAddPCH" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAddPCH">Новый промокод</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.promocodes.add') }}" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="pPromocode">Промокод</label>
                        <input name="promocode" type="text" class="form-control" placeholder="EXAMPLECODE" value="{{ old('promocode') }}" id="pPromocode" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pDiscount">Скидка в %</label>
                        <input name="discount" type="number" class="form-control" placeholder="5" value="{{ old('discount') }}" id="pDiscount" step="1" min="1" max="99" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pLimit">Лимит активаций (0 - бесконечно)</label>
                        <input name="activation_limit" type="number" class="form-control" placeholder="15" value="{{ old('activation_limit') }}" id="pLimit" step="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pDate">Срок действия (не указан - бесконечно)</label>
                        <input name="expires_at" type="date" class="form-control" id="pDate" value="" min="{{ \Carbon\Carbon::now('Europe/Moscow')->addDay()->format('Y-m-d') }}" max="{{ \Carbon\Carbon::now('Europe/Moscow')->addWeek()->format('Y-m-d') }}">
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
