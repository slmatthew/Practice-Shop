<div class="modal fade" id="{{ "mDelete{$user->id}" }}" tabindex="-1" aria-labelledby="{{ "mDeleteH{$user->id}" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "mDeleteH{$user->id}" }}">{{ $user->name }} {{ $user->surname }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.users.delete', ['user' => $user]) }}">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="{{ $user->id }}" />

                <div class="modal-body">
                    @if(Auth::user()->id == $user->id)
                        <b class="text-danger">Внимание: это ваш аккаунт!</b>
                    @endif
                    Вы действительно хотите удалить этого пользователя?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>
