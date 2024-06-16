<?php

namespace App\Orchid\Layouts\Type;


use App\Models\Type;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TypeListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'types';

    /**
     * @return TD[]
     */
    public function columns(): array
    {

        return [
            TD::make('id', __('Type Id')),

            TD::make('type', __('Type'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Type $type) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.type.edittype', $type->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            //->route('platform.type.typelist', $type->id)
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $type->id,
                            ]),
                    ])),
        ];
    }


  
}
