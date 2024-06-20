@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            {{-- ユーザー情報 --}}
            @include('users.card')
        </aside>
        <div class="sm:col-span-2 mt-4">
            @if (Auth::id() == $user->id || Auth::user()->is_following($user->id))
            {{-- @if(\Auth::user()->id == $user->id ||\Auth::user()->followings() == $user->followers()) --}}
            {{-- タブ --}}  
            @include('users.navtabs')
            {{-- 投稿フォーム --}}
            @include('microposts.form')
            {{-- 投稿一覧 --}}
            @include('microposts.microposts')
            @else
            <div>
            <font size=6>
                <svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 inline">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                </font>
            <font size=6 color="red">フォローしていないユーザーの詳細は閲覧できません</font>
            <font size=6></font>
            </div>
            <div>
            <font size=6>閲覧する場合にはユーザーをフォローしてください</font>
            </div>
            @endif
        </div>
    </div>
@endsection