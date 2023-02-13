@extends('layouts.app')

@section('content')
<div class="card__header">
  <p class="title mb-15">Todo List</p>
  <div class="auth mb-15">
    <p class="detail">「{{ $user->name }}」でログイン中</p>
    <form method="post" action="/logout">
      @csrf
      <input class="btn btn-logout" type="submit" value="ログアウト">
    </form>
  </div>
</div>
<a class="btn btn-search" href="{{ route('todo.find') }}">タスク検索</a>
@if (count($errors) > 0)
<ul>
  @foreach ($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
</ul>
@endif
<div class="todo">
  <form action="{{ route('todo.create') }}" method="post" class="flex between mb-30">
    @csrf
    <input type="text" class="input-add" name="content" />
    <select name="tag_id" class="select-tag">
      @foreach($tags as $tag)
      <option value="{{ $tag->id }}">{{ $tag->name }}</option>
      @endforeach
    </select>
    <input class="btn btn-add" type="submit" value="追加" />
  </form>
  <table>
    <tr>
      <th>作成日</th>
      <th>タスク名</th>
      <th>タグ</th>
      <th>更新</th>
      <th>削除</th>
    </tr>
    @foreach($todos as $todo)
    <tr>
      <td>
        {{ $todo->created_at }}
      </td>
      <form action="{{ route('todo.update', ['id' => $todo->id]) }}" method="post">
        @csrf
        <td>
          <input type="text" class="input-update" value="{{ $todo->content }}" name="content" />
        </td>
        <td>
          <select name="tag_id" class="select-tag">
            @foreach($tags as $tag)
            <option {{ $todo->isSelectedTag($tag->id) }} value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
          </select>
        </td>
        <td>
          <button class="btn btn-update">更新</button>
        </td>
      </form>
      <td>
        <form action="{{ route('todo.delete', ['id' => $todo->id]) }}" method="post">
          @csrf
          <button class="btn btn-delete">削除</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection