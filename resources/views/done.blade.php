@extends('layouts.app')

@section('content')
<p class="title mb-15">完了済みタスク</p>
<div class="todo">
  <table>
    <tr>
      <th>作成日</th>
      <th>タスク名</th>
      <th>タグ</th>
      <th>削除</th>
    </tr>
    @foreach($dones as $done)
    <tr>
      <td>
        {{ $done->created_at }}
      </td>
      <td>
        <p>{{ $done->content }}</p>
      </td>
      <td>
        <p>{{ $done->tag->name }}</p>
      </td>
      <td>
        <form action="{{ route('todo.forceDelete', ['id' => $done->id]) }}" method="post">
          @csrf
          <button class="button-delete">削除</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<a class="button-back" href="{{ route('todo.index') }}">戻る</a>
@endsection
