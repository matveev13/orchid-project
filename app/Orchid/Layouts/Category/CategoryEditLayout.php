<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Category;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CategoryEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('category.category')
                ->type('text')
                ->max(255)
                // ->required()
                // ->title(__('Name'))
                // ->placeholder(__('Name')),

          
        ];
    }
}
