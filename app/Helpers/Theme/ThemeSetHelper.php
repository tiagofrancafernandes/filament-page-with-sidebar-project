<?php

namespace App\Helpers\Theme;

class ThemeSetHelper
{
    /**
     * getValidThemeName function
     *
     * @param ?string $themeName
     * @return string
     */
    public static function getValidThemeName(?string $themeName = \null): string
    {
        $allowedThemes = [
            'basic',
            'news',
            'one',
            'two',
        ];

        return $allowedThemes[$themeName] ?? static::getDefaultTheme();
    }

    /**
     * getDefaultTheme function
     *
     * @return string
     */
    public static function getDefaultTheme(): string
    {
        return 'one';
    }

    /**
     * getSessionTheme function
     *
     * @return string|null
     */
    public static function getSessionTheme(): ?string
    {
        return \session()->get('theme-name');
    }

    /**
     * setSessionTheme function
     *
     * @param string $themeName
     * @return void
     */
    public static function setSessionTheme(string $themeName): void
    {
        \session()->put('theme-name', static::getValidThemeName($themeName));
    }

    /**
     * getTheme function
     *
     * @param string $themeName
     * @return string
     */
    public static function getTheme(): string
    {
        return static::getValidThemeName(
            static::getSessionTheme() ?: static::getDefaultTheme()
        );
    }

    /**
     * getThemeView function
     *
     * @param string|null $view
     *
     * @param \Illuminate\Contracts\Support\Arrayable|array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public static function getThemeView($data = [], $mergeData = [])
    {
        $theme = static::getTheme();

        return view(
            "components.themes.{$theme}.main",
            $data,
            $mergeData
        );
    }
}
