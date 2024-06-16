<?php

namespace App\Orchid\Screens\Type;

use App\Models\Type;
use App\Orchid\Layouts\Type\TypeListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Button;

class TypeList extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
//public $type;

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

    public function asyncGetType(Type $type): iterable
    {
        return [
            'type' => $type,
        ];
    }
    public function remove( Type $type)
    {
        //Type::findOrFail($request->get('type'))->delete();
      $type->delete();
       // $this->type->fill($this->type = $request->get('type'))
         //   ->save();
         Toast::info(__('Type was removed'));

        return redirect()->route('platform.type.typelist');
    }
}

