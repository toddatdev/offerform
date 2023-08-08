<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use App\Models\CategoryUserDisplayOrder;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    public $isEditing = false;
    public $isCreating = false;


    public $limitPerPage = 15;


    protected $listeners = [
        'load-more' => 'loadMore',
        'categories-refresh' => '$refresh',
    ];

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 15;
    }

    public function render()
    {
        $categories = Category::getQuery();
//        dd($categories);
        return view('livewire.categories.index', compact('categories'))->layout('layouts.app');
    }

    public function changeSectionSortOrder($sortOrders)
    {
        Category::changeSortOrder($sortOrders);

        foreach ($sortOrders as $sortOrder) {
            $model = CategoryUserDisplayOrder::firstOrNew([
                'category_id' => $sortOrder['value'],
                'user_id' => $this->user->id
            ]);

            $model->fill([
                'display_order' => $sortOrder['order']
            ]);

            $model->save();
        }
    }

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $this->emit('hideModal');
            $this->emit('showToast', 'Success!', 'Category Deleted Successfully!');
            $category->delete();
        }

        $this->emit('categories-refresh');
    }
}
