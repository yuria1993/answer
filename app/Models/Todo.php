<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Todo extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    public function tag()
    {
        return $this->BelongsTo(Tag::class);
    }
    public static function doSearch($keyword, $tag_id)
    {
        $user_id = Auth::id();
        $query = self::query();
        if (!empty($keyword)) {
            $query->where('content', 'like binary', "%{$keyword}%");
        }
        if (!empty($tag_id)) {
            $query->where('tag_id', 'like binary', "%{$tag_id}%");
        }
        $query->where('user_id', '=', $user_id);
        $results = $query->get();
        return $results;
    }
    function isSelectedTag($tag_id)
    {
        return $this->tag_id == $tag_id ? 'selected' : '';
    }
}
