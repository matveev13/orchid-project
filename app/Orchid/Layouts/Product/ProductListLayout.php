<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'products';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', __('Id')),

            TD::make('title', __('Title'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

                TD::make('description', __('Description'))
                ->sort()
                
                ->filter(Input::make()),
                
                TD::make('season', __('Season'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

                TD::make('sex', __('Sex'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

                TD::make('color', __('Color'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

                TD::make('price', __('Price'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

                TD::make('quantity_in_stock', __('Quantity in stock'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),


            

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Product $product) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                         Link::make(__('Edit'))
                            ->route('platform.products.editproduct', $product->id)
                            ->icon('bs.pencil'), 

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $product->id,
                            ]),
                    ])),
        ];
    }
}
