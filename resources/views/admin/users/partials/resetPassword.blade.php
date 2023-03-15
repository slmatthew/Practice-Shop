<div class="modal fade" id="{{ "mRP{$user->id}" }}" tabindex="-1" aria-labelledby="{{ "mRPH{$user->id}" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "mRPH{$user->id}" }}">{{ $user->name }} {{ $user->surname }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.users.resetPassword', ['user' => $user]) }}">
                @csrf
                @method('POST')

                <input type="hidden" name="id" value="{{ $user->id }}" />

                <div class="modal-body">
                    @if(Auth::user()->id == $user->id)
                        <b class="text-danger">Внимание: это ваш аккаунт!</b>
                    @endif
                    Вы действительно хотите сбросить пароль этого пользователя?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Сбросить</button>
                </div>
            </form>
        </div>
    </div>
</div>
