<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $category;

    public $image;

    public $creating = false;

    public $isEditing = false;

    protected $rules = [
        'category.name' => ['required', 'string', 'max:100'],
    ];

    public function mount($id = null)
    {
        $this->category = new Category();
        if ($id) {
            $this->category = Category::find($id);
        }
    }

    public function render()
    {
        return view('livewire.categories.form');
    }

    public function onChangeImage()
    {
        if ($this->image) {
            $this->category->upload($this->image, 'image');
        }
    }

    public function save() {
        $this->validate();
        $this->onChangeImage();

        $this->category->slug = !$this->category->slug ? Str::slug($this->category->name) . '-' . uniqid() : $this->category->slug;

        $this->category->user_id = auth()->user()->hasRole(['super-admin', 'admin']) ? null : auth()->user()->id;
        $this->category->save();

        if ($this->creating) {
            $this->category = new Category();
            $this->emit('showToast', 'Success!', 'New category created successfully!');
        } else {
            $this->emit('showToast', 'Success!', 'Changes saved successfully!');
        }

        $this->image = null;
        $this->isEditing = false;
        $this->creating = false;
        $this->emit('categories-refresh');

    }
}
