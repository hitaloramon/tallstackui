<?php

namespace TallStackUi\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;
use Illuminate\View\ComponentSlot;
use TallStackUi\View\Components\Form\Traits\SetupRadioCheckboxToggle;
use TallStackUi\View\Personalizations\Contracts\Personalization;
use TallStackUi\View\Personalizations\SoftPersonalization;
use TallStackUi\View\Personalizations\Traits\InteractWithProviders;

#[SoftPersonalization('form.toggle')]
class Toggle extends Component implements Personalization
{
    use InteractWithProviders;
    use SetupRadioCheckboxToggle;

    public function __construct(
        public string|null|ComponentSlot $label = null,
        public ?string $color = 'primary',
        public bool $checked = false,
    ) {
        $this->setup();
        $this->colors();
    }

    public function personalization(): array
    {
        return Arr::dot([
            'wrapper' => 'relative flex items-center justify-end',
            'input' => [
                'class' => 'peer absolute inset-y-0 left-0.5 translate-x-0 my-0.5 transform cursor-pointer appearance-none rounded-full border-0 bg-white shadow transition duration-200 ease-in-out checked:bg-none checked:text-white focus:outline-none focus:ring-0 focus:ring-offset-0',
                'sizes' => [
                    'xs' => 'h-2 w-2 checked:translate-x-2',
                    'sm' => 'h-3 w-3 checked:translate-x-3',
                    'md' => 'h-4 w-4 checked:translate-x-4',
                    'lg' => 'h-5 w-5 checked:translate-x-4',
                ],
            ],
            'background' => [
                'class' => 'bg-secondary-200 dark:bg-dark-700 block cursor-pointer rounded-full transition duration-100 ease-in-out group-focus:ring-2 group-focus:ring-offset-2 peer-focus:ring-2 peer-focus:ring-offset-2',
                'sizes' => [
                    'xs' => 'h-3 w-5',
                    'sm' => 'h-4 w-7',
                    'md' => 'h-5 w-9',
                    'lg' => 'h-6 w-10',
                ],
            ],
            'error' => 'bg-red-600 group-focus:ring-red-600 peer-checked:bg-red-600 peer-focus:ring-red-600',
        ]);
    }

    public function render(): View
    {
        return view('tallstack-ui::components.form.toggle');
    }
}
