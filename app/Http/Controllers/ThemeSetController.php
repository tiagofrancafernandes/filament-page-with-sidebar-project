<?php

namespace App\Http\Controllers;

use App\Helpers\Theme\ThemeSetHelper;
use Illuminate\Http\Request;

class ThemeSetController
{
    public function __invoke(Request $request, ?string $themeName = 'one')
    {
        $themeName =  ThemeSetHelper::getValidThemeName($themeName ?: ThemeSetHelper::getSessionTheme());

        ThemeSetHelper::setSessionTheme($themeName);

        return \redirect()
            ->to(\route('posts.index'))
            ->with(
                'success',
                __('Theme :themename enabled successfully', [
                    'themename' => $themeName
                ])
            );
    }
}
