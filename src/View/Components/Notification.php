<?php

namespace TasteUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notification extends Component
{
    public function __construct(
        public ?string $zIndex = 'z-50',
        public ?string $position = 'top-right',
    ) {
        //
    }

    public function render(): View
    {
        return view('taste-ui::components.notification');
    }
}
