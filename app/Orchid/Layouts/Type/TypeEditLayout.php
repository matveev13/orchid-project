<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Type;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class TypeEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('type.type')
                ->type('text')
                ->max(255)
                 ->required()
                 ->title(__('Type'))
                 //->placeholder(__('Type')),

          
        ];
    }
}
