<?php

namespace App\Orchid\Screens\Type;

use App\Models\Type;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;

class AddType extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'AddType';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('SaveType')
            ->icon('bs.check-circle')
            ->method('SaveType'), 
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
            Layout::rows([

                /*--  Тип  --*/
                Input::make('type')
                ->type('string')
                ->required()
                ->title(__('Category'))
                ->placeholder(__('введи новый тип')),
            ])
        ];
    }

    public function SaveType(Request $request)
    {
        if(Type::where('type', $request->get('type'))->count() > 0){
            Alert::error('Тип дублируется.');
            return;
        }
        $type = new Type();
        $type->type = $request->get('type');
        $type->save();
    


        Alert::info('Товар успешно добавлен в базу.');
    }

}
