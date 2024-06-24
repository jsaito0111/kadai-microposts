@if (Auth::user()->is_favorite($user->id))
    {{-- アンフォローボタンのフォーム --}}
    <form method="POST" action="{{ route('users.unfavorites', $user->id) }}">
        @csrf
        @method('DELETE')
        <div>
        <button type="submit" id="searchsubmit" value="Search"class="btn btn-ghost normal-case"><i class="icon-search">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="red" viewBox="0 0 24 24" stroke="red" stroke-width="1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </button>
        </div>
    </form>
@else
    {{-- フォローボタンのフォーム --}}
    <form method="POST" action="{{ route('users.favorites', $user->id) }}">
        @csrf
        <div>
        <button type="submit" id="searchsubmit" value="Search"class="btn btn-ghost normal-case"><i class="icon-search">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </button>
    </div>
    </form>
@endif