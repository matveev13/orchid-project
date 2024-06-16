<?php

namespace App\Orchid\Screens\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Alert;


class AddProduct extends Screen
{

    public $product;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Product $product): iterable
    {
        return [
            'product' => $product,        
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'AddProduct';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [



            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->product->exists),

            /*      Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'), */

            Button::make('SaveProduct')
                ->icon('bs.check-circle')
                ->method('SaveProduct'),

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

                /*--  Сезон  --*/
                Select::make('type_id')
                ->options(
                   Type::all()->pluck('type', 'id')
                )
                    ->title('Выбери тип товара'),
                    //->help('сезон'),

                      /*--  Название  --*/

                Select::make('category_id')
                ->options(
                   Category::all()->pluck('category', 'id')
                )
                ->title('Выбери категорию товара'),
                 /*--  Категория  --*/
               /*   Input::make('category')
                 ->type('string')
                 ->required()
                 ->title(__('Category'))
                 ->placeholder(__('введи размер')),
 */
                Input::make('title')
                    ->type('text')
                    ->required()
                    ->title(__('Название товара'))
                    ->placeholder(__('название товара')), 

                /*--  Пол  --*/
                Select::make('sex')
                    ->options([
                        'М' => 'Мужская',
                        'Ж' => 'Женская',
                    ])
                    ->title('Выбери пол')
                    ->help('М/Ж'),

                /*--  Цвет  --*/
                Select::make('color')
                    ->options([
                        'Чёрный' => 'Чёрный',
                        'Коричневый' => 'Коричневый',
                        'Белый' => 'Белый',
                        'Серый' => 'Серый',
                        'Жёлтый' => 'Жёлтый',
                    ])
                    ->title('Выбери цвет'),
                    //->help('цвет'),

                /*--  Размер  --*/
                Input::make('size')
                    ->type('integer')
                    ->required()
                    ->title(__('Размер'))
                    ->placeholder(__('введи размер')),

                /*--  Цена  --*/
                Input::make('price')
                    ->type('integer')
                    ->required()
                    ->title(__('Цена'))
                    ->placeholder(__('введи цену')),

              

                /*--  Описание  --*/
                Input::make('description')
                    ->type('text')
                    ->required()
                    ->title(__('Описание товара'))
                    ->placeholder(__('описание товара')),

                     /*--  Количество на складе  --*/
                Input::make('quantity_in_stock')
                ->type('integer')
                ->required()
                ->title(__('Количество на складе'))
                ->placeholder(__('количество на складе')),
            ])

        ];
    }

    public function SaveProduct(Request $request)
    {
        $product = new Product();
        $product->category_id = $request->get('category_id');
        $product->sex = $request->get('sex');
        $product->color = $request->get('color');
        $product->size = $request->get('size');
        $product->price = $request->get('price');
        $product->title = $request->get('title');
        $product->description = $request->get('description');
        $product->quantity_in_stock = $request->get('quantity_in_stock');
        $product->save();



        Alert::info('Товар успешно добавлен в базу.');
    }
}
