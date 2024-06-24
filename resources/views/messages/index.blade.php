@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    @if (Auth::user()->is_following($user->id) && $user->is_following(Auth::user()->id))
    <h1 class="text-xl font-bold">Messages with {{ $user->name }}</h1>
        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded">
                {{ session('success') }}
            </div>
        @endif
    
        <form action="{{ route('messages.send', ['userId' => $user->id]) }}" method="POST" class="mt-6">
            @csrf
            <textarea name="message" class="w-full p-2 border rounded" placeholder="Write a message..."></textarea>
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
                Send
            </button>
        </form>

        <div class="space-y-4 mt-4">
            @forelse ($messages as $message)
                <div class="p-4 bg-gray-100 rounded shadow">
                    <figure>
                    {{-- ユーザーのメールアドレスをもとにGravatarを取得して表示 --}}
                    <img src="{{ Gravatar::get($user->email, ['size' => 30]) }}" alt="">
                    </figure>
                    <p class="font-semibold {{ $message->sender_id == auth()->id() ? 'text-blue-500' : 'text-green-500' }}">
                        {{ $message->sender_id == auth()->id() ? 'You' : $user->name }}:
                    </p>
                    <p>{{ $message->message }}</p>
                    <div class="text-sm text-gray-600">
                        Sent on {{ $message->created_at->format('M d, Y h:i A') }}
                    </div>
                </div>
            @empty
                <p>No messages yet.</p>
            @endforelse
        </div>
    @else
        <div>
            <div>
                <font size=8>You can't send messages for {{ $user->name }}!!</font>
            </div>
            <div>
                <font size=5>メッセージを送るには相互フォロー状態である必要があります</font>
            </div>
               <font size=5>
                   <svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                   </svg>
              </font>
           <font size=5 color="red">相互フォローではないユーザーにメッセージを送信できません</font>
           <font size=5></font>
        </div>
    @endif
</div>
@endsection