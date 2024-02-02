<?php

namespace App\Repositories;

use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategoryRepository implements SubCategoryInterface
{
    protected $subCategory;

    public function __construct(SubCategory $category)
    {
        $this->subCategory = $subCategory;
    }

    public function all()
    {
        return $this->subCategory->all();
    }

    public function find($id)
    {
        return $this->subCategory->findOrFail($id);
    }

    public function create(array $data, $image)
    {
        if ($image) {
            $imageName = 'IMG_' . date('YmdHi') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/sub_category'), $imageName);
            $data['image'] = $imageName;
        }

        $data['slug'] = Str::slug($data['name']);

        return $this->subCategory->create($data);
    }

    public function update(array $data, $id, $image)
    {
        $subCategory = $this->subCategory->findOrFail($id);

        if ($image) {
            @unlink(public_path('upload/sub_category/'.$subCategory->image));
            $imageName = 'IMG_' . date('YmdHi') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/sub_category'), $imageName);
            $data['image'] = $imageName;
        }

        $data['slug'] = Str::slug($data['name']);

        return $subCategory->update($data);
    }

    public function destroy($id)
    {
        return $this->subCategory->findOrFail($id)->delete();
    }
}
