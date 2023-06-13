<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\Http\Request;

class ShowController
{
    public function __invoke(Request $request, string $postSlug)
    {
        return view('posts.show', [
            'post' => static::getData($postSlug),
        ]);
    }

    protected static function getData(string $postSlug): Post
    {
        // TODO: mo it to external theme settings

        return Post::whereSlug($postSlug)
            ->published()
            ->firstOrFail();
    }
}
