<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Helpers\Theme\ThemeSetHelper;

class ThemeSet extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $title = \null,
        public ?string $resource = 'index',
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return ThemeSetHelper::getThemeView([
            'title' => $this->title,
            'resource' => $this->resource,
        ]);
    }
}
