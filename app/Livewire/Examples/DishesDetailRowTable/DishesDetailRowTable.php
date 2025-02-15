<?php

namespace App\Livewire\Examples\DishesDetailRowTable;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

class DishesDetailRowTable extends PowerGridComponent
{
    public function setUp(): array
    {
        return [
            Header::make()
                ->showSearchInput(),

            Footer::make()
                ->showPerPage(5)
                ->showRecordCount(),

            Detail::make()
                ->view('components.detail')
                ->params(['name' => 'Luan'])
                ->showCollapseIcon(),
        ];
    }

    public function datasource(): ?Builder
    {
        return $this->query();
    }

    public function query(): Builder
    {
        return Dish::with('category');
    }

    public function join(): Builder
    {
        return Dish::query()
            ->join('categories', function ($categories) {
                $categories->on('dishes.category_id', '=', 'categories.id');
            })
            ->select('dishes.*', 'categories.name as category_name');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),

            Column::action('Action'),
        ];
    }

    public function actions(): array
    {
        return [
            Button::make('toggleDetail', 'Click to Toggle Detail')
                ->class('bg-blue-500 text-white font-bold py-2 px-2 rounded')
                ->toggleDetail(),
        ];
    }

    public function actionRules(): array
    {
        return [
            Rule::rows()
                ->when(fn ($dish) => $dish->id == 1)
                ->detailView('components.detail-rules', ['fromActionRule' => true]),
        ];
    }
}
