<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all()
    {
        return $this->category->all();
    }

    public function find($id)
    {
        return $this->category->findOrFail($id);
    }

    public function create(array $data, $image)
    {
        if ($image) {
            $imageName = 'IMG_' . date('YmdHi') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/category'), $imageName);
            $data['image'] = $imageName;
        }

        $data['slug'] = Str::slug($data['name']);

        return $this->category->create($data);
    }

    public function update(array $data, $id, $image)
    {
        $category = $this->category->findOrFail($id);

        if ($image) {
            @unlink(public_path('upload/category/'.$category->image));
            $imageName = 'IMG_' . date('YmdHi') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/category'), $imageName);
            $data['image'] = $imageName;
        }

        $data['slug'] = Str::slug($data['name']);

        return $category->update($data);
    }

    public function destroy($id)
    {
        return $this->category->findOrFail($id)->delete();
    }
}
