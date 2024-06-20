@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>id = {{ $micropost->id }} の投稿詳細ページ</h2>
    </div>

    <table class="table w-full my-4">
        <tr>
            <th>id</th>
            <td>{{ $micropost->id }}</td>
        </tr>

        <tr>
            <th>投稿</th>
            <td>{{ $micropost->content }}</td>
        </tr>
    </table>

    <a class="btn btn-outline" href="{{ route('microposts.edit', $task->id) }}">この投稿を編集</a>
@endsection