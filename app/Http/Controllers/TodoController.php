<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $tags = Tag::all();
        $todos = $user->todos;
        return view('index', ['todos' => $todos, 'user' => $user, 'tags' => $tags]);
    }
    public function create(TodoRequest $request)
    {
        $todo = new Todo;
        $form = $this->unsetToken($request);
        $form['user_id'] = Auth::id();
        $todo->fill($form)->save();
        return back();
    }
    public function update(TodoRequest $request)
    {
        $user = Auth::user();
        $todo = Todo::find($request->id);
        if($todo->user->id !== $user->id) return back();
        $form = $this->unsetToken($request);
        $todo->fill($form)->save();
        return back();
    }
    public function delete(Request $request)
    {
        $user = Auth::user();
        $todo = Todo::find($request->id);
        if ($todo->user_id !== $user->id) return back();
        $todo->delete();
        return back();
    }
    public function find()
    {
        $user = Auth::user();
        $tags = Tag::all();
        $todos = [];
        return view('search', ['todos' => $todos, 'user' => $user, 'tags' => $tags]);
    }
    public function search(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::all();
        $keyword = $request['content'];
        $tag_id = $request['tag_id'];
        $todos = Todo::doSearch($keyword, $tag_id);
        return view('search', ['todos' => $todos, 'user' => $user, 'tags' => $tags]);
    }

    public function unsetToken($request)
    {
        $form = $request->all();
        unset($form['_token']);
        return $form;
    }
}
