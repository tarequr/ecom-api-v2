<?php

namespace App\Repositories;

use App\Models\Category;

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
        return $this->category->find($id);
    }

    public function create(array $data)
    {
        return $this->category->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->category->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->category->find($id)->destroy();
    }
}
