<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Support\Str;

class BrandRepository implements BrandInterface
{
    protected $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function all()
    {
        return $this->brand->all();
    }

    public function find($id)
    {
        return $this->brand->findOrFail($id);
    }

    public function create(array $data, $image)
    {
        if ($image) {
            $imageName = 'IMG_' . date('YmdHi') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/brand'), $imageName);
            $data['image'] = $imageName;
        }

        $data['slug'] = Str::slug($data['name']);

        return $this->brand->create($data);
    }

    public function update(array $data, $id, $image)
    {
        $brand = $this->brand->findOrFail($id);

        if ($image) {
            @unlink(public_path('upload/brand/'.$brand->image));
            $imageName = 'IMG_' . date('YmdHi') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/brand'), $imageName);
            $data['image'] = $imageName;
        }

        $data['slug'] = Str::slug($data['name']);

        return $brand->update($data);
    }

    public function destroy($id)
    {
        return $this->brand->findOrFail($id)->delete();
    }
}
