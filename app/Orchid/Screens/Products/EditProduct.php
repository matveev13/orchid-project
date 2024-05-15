<?php

namespace App\Orchid\Screens\Products;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductEditLayout;
//use Faker\Core\Color;
use Orchid\Support\Color;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class EditProduct extends Screen
{

    public $product;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(int $id): array
    {
        $this->product = Product::find($id);
        return [
            'product'=>  $this->product,
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
    public function commandBar(): iterable
    {
        return [
           // Button::make(__('Impersonate user'))
           // ->icon('bg.box-arrow-in-right')
           // ->confirm(__('You can revert to your original state by logging out.'))
           // ->method('loginAs'),
            //->canSee($this->product->exists && $this->product->id !== \request()->product()->id),

        // Button::make(__('Remove'))
        //     ->icon('bs.trash3')
        //     ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
        //     ->method('remove'),
        //     //->canSee($this->product->exists),

        // Button::make(__('Save'))
        //     ->icon('bs.check-circle')
        //     ->method('save'),
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
            Layout::block(ProductEditLayout::class)
            ->title(__('Profile Information'))
            ->description(__('Update your account\'s profile information and email address.'))
            ->commands(
                Button::make(__('Save'))
                    ->type(Color::BASIC)
                    ->icon('bs.check-circle')
                    //->canSee($this->product->exists)
                    ->method('save')
            ),
        ];
    }
}
