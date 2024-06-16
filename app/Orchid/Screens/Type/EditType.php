<?php

namespace App\Orchid\Screens\Type;



use App\Orchid\Layouts\Type\TypeEditLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Support\Facades\Toast;

use App\Models\Type;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;


class EditType extends Screen
{

    public $type;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(int $id): iterable
    {
        $this->type = Type::find($id);

        return [
            'type' =>  $this->type
        ];
      
    }


    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    // public function name(): ?string
    // {
    //     /* return $this->product->exist ? 'Редактировать товар' : 'Добавить товар'; */

    //     return $this->product->id('name');
    // }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar()
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
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
            Layout::block(TypeEditLayout::class)
                ->title(__('Type Information'))
                ->description(__('Update your types'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        //->canSee($this->type->exists)
                        ->method('save')
                ),
        ];
    }

    public function save( Request $request)
    {
        if (Type::where('type', $request->get('type'))->count() > 0) {
            Alert::error('Тип дублируется.');
            return;
        }
        $this->type->fill($this->type = $request->get('type'))
            ->save();
            Toast::info(__('Type was removed'));
        return redirect()->route('platform.type.typelist');
    }
}
