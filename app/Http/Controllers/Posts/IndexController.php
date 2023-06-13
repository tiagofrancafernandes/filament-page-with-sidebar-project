<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use App\Helpers\Theme\ThemeSetHelper;

class IndexController
{
    public function __invoke()
    {
        return view(
            'posts.index',
            static::getData()
        );
    }

    protected static function getData(
        ?string $themeName = \null
    ): array {
        // TODO: mo it to external theme settings

        $themeName = ThemeSetHelper::getValidThemeName($themeName);

        $query = Post::query();

        switch ($themeName) {
            case 'basic':
            case 'news':
            case 'one':
            case 'two':
            default:
                return [
                    'posts' => $query
                        ->published()
                        ->orderBy('published_at', 'DESC')
                    ->paginate(10),
                ];

                break;
        }
    }
}
