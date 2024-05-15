<?php

namespace App\Orchid\Screens\Products;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductListLayout;
//use App\Orchid\Layouts\User\ProductEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;




class ProductsList extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */

    public function query(): iterable
    { 
        return [
            'products' => Product::all()    
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ProductsList';
       
    }

    public function description(): ?string
    {
        return 'Список товаров';
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
                ->route('platform.products.addproduct'),
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
            ProductListLayout::class,
        ];
    }


    public function saveUser(Request $request, Product $product): void
    {
        $product->fill($request->input('product'))->save();

        Toast::info(__('Product was saved.'));
    }

    public function remove(Request $request): void
    {
        Product::findOrFail($request->get('id'))->delete();

        Toast::info(__('User was removed'));
    }
}
