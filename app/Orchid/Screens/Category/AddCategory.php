<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use App\Models\Type;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Alert;

use function Laravel\Prompts\select;

class AddCategory extends Screen
{
    public $category;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Category $category): array
    {
        return 

          // [ 'category' => $category,]
   [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'AddCategory';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
             Button::make('SaveCategory')
                ->icon('bs.check-circle')
                ->method('SaveCategory'), 
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
                Select::make('type_id')
                ->options(
                   Type::all()->pluck('type', 'id')
                )
                ->title('Выбери сезон'),
                 /*--  Категория  --*/
                 Input::make('category')
                 ->type('string')
                 ->required()
                 ->title(__('Category'))
                 ->placeholder(__('введи размер')),
            ]) 
        ];
    }

    public function SaveCategory(Request $request)
    {
        if(Category::where('category', $request->get('category'))->count() > 0){
            Alert::error('Категория дублируется.');
            return;
        }
        $category = new Category();
        $category->category = $request->get('category');
        $category->type_id = $request->get('type_id');
        $category->save();
    


        Alert::info('Товар успешно добавлен в базу.');
    }
}
