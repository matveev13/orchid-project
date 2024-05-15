<?php

namespace App\Orchid\Screens\Type;

use App\Models\Type;
use App\Orchid\Layouts\Type\TypeListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class TypeList extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'types' => Type::all()
        ];
        
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'TypeList';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
            ->icon('bs.plus-circle')
            ->route('platform.type.addtype'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
     public function layout(): iterable
    {
        return [
            TypeListLayout::class
        ];
        
    } 
}
