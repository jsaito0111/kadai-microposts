@if (Auth::user()->is_favorite($user->id))
    {{-- アンフォローボタンのフォーム --}}
    <form method="POST" action="{{ route('users.unfavorite', $user->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-error btn-block normal-case" 
            onclick="return confirm('id = {{ $user->id }} のお気に入りを外します。よろしいですか？')">Unfavorite</button>
    </form>
@else
    {{-- フォローボタンのフォーム --}}
    <form method="POST" action="{{ route('users.favorite', $user->id) }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-block normal-case">Favorite</button>
    </form>
@endif