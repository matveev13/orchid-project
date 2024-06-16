<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Product;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ProductEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('product.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Title'))
                ->placeholder(__('Title')),

          
        ];
    }
}
