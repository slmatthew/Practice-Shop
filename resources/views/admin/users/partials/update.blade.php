<div class="modal fade" id="{{ "mUpdate{$user->id}" }}" tabindex="-1" aria-labelledby="{{ "mUpdateH{$user->id}" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "mUpdateH{$user->id}" }}">{{ $user->name }} {{ $user->surname }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="{{ route('admin.users.update', ['user' => $user]) }}">
                @csrf

                <input type="hidden" name="id" value="{{ $user->id }}" />

                <div class="modal-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{ $user->image }}"
                             alt="{{ "@{$user->username}" }} image" class="img-fluid img-thumbnail mt-4 mb-2"
                             style="width: 150px; z-index: 1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="{{ "u{$user->id}-name" }}">Имя</label>
                        <input name="name" id="{{ "u{$user->id}-name" }}" type="text" class="form-control" placeholder="Денис" value="{{ $user->name ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="{{ "u{$user->id}-surname" }}">Фамилия</label>
                        <input name="surname" id="{{ "u{$user->id}-surname" }}" type="text" class="form-control" placeholder="Петров" value="{{ $user->surname ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="{{ "u{$user->id}-username" }}">Логин</label>
                        <div class="input-group">
                            <span class="input-group-text">@</span>
                            <input id="{{ "u{$user->id}-username" }}" type="text" class="form-control" value="{{ $user->username ?? '' }}" disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="{{ "u{$user->id}-phone" }}">Телефон</label>
                        <div class="input-group">
                            <span class="input-group-text">7</span>
                            <input name="phone" id="{{ "u{$user->id}-phone" }}" type="tel" class="form-control" pattern="[0-9]{10}" placeholder="9991234567" value="{{ $user->phone ?? '' }}">
                        </div>
                    </div>

                    @if($user->id != 1)
                        <hr class="my-4" />

                        <div class="mb-3">
                            <label class="form-label" for="{{ "u{$user->id}-role" }}">Роль</label>
                            <select name="role" class="form-select" id="{{ "u{$user->id}-role" }}">
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Пользователь</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Админ</option>
                            </select>
                        </div>
                    @endif

                    @if($user->image != 'https://vk.com/images/camera_200.png')
                        <hr class="my-4" />

                        <div class="mb-3">
                            <input name="deleteImage" id="{{ "u{$user->id}-deleteImage" }}" class="form-check-input" type="checkbox" value="1">
                            <label class="form-label" for="{{ "u{$user->id}-deleteImage" }}">Удалить изображение</label>
                        </div>
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ route('user.user', ['user' => $user]) }}" target="_blank" role="button" class="btn btn-outline-secondary mr-auto">Открыть</a>
                    <div class="ml-auto">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
