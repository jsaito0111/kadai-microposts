<div class="mt-4">
    @if (isset($users))
        <ul class="list-none">
            @foreach ($users as $user)
                <li class="flex items-start gap-x-2 mb-4">
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    <div class="avatar">
                        <div class="w-12 rounded">
                            <img src="{{ Gravatar::get($user->user->email) }}" alt="" />
                        </div>
                    </div>
                    <div>
                        <div>
                            {{-- 投稿の所有者のユーザー詳細ページへのリンク --}}
                            <a class="link link-hover text-info" href="{{ route('users.show', $user->user->id) }}">{{ $user->user->name }}</a>
                            <span class="text-muted text-gray-500">posted at {{ $user->created_at }}</span>
                        </div>
                        <div>
                            {{-- 投稿内容 --}}
                            <p class="mb-0">{!! nl2br(e($user->content)) !!}</p>
                            @include('user_favorite.favorited_button')
                        </div>
                        <div>
                            @if (Auth::id() == $user->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('microposts.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case" 
                                        onclick="return confirm('Delete id = {{ $user->id }} ?')">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク
        {{ $microposts->links() }}--}}
    @endif
</div>

{{--
<div>
    <div>
        <a class="link link-hover text-info" href="{{ route('users.show', $micropost->user->id) }}">{{ $micropost->user->name }}</a>
        <span class="text-muted text-gray-500">posted at {{ $micropost->created_at }}</span>
    </div>
    <div>
       
        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
        @include('user_favorite.favorite_button')
    </div>
    <div>
    @if (Auth::id() == $micropost->user_id)
        <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
            @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error btn-sm normal-case" 
                onclick="return confirm('Delete id = {{ $micropost->id }} ?')">Delete</button>
            </form>
        @endif
    </div>
</div>
                    
--}}