@if (isset($users))
    <ul class="list-none">
        @foreach ($users as $user)
            <li class="flex items-center gap-x-4 mb-4">
                {{-- ユーザーのメールアドレスをもとにGravatarを取得して表示 --}}
                <div class="avatar">
                    <div class="w-14 rounded">
                        <img src="{{ Gravatar::get($user->email) }}" alt="" />
                    </div>
                </div>
                <div>
                    <div>
                        {{ $user->name }}
                    </div>
                    <div>
                        {{-- ユーザー詳細ページへのリンク --}}
                        <p><a class="link link-hover text-info" href="{{ route('users.show', $user->id) }}">View profile</a></p>
                         @include('user_follow.follow_button')
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
@endif