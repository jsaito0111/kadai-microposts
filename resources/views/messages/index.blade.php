@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
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
</div>
@endsection