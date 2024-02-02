<?php

namespace App\Repositories;

interface BrandInterface
{
    public function all();
    public function find($id);
    public function create(array $data, $image);
    public function update(array $data, $id, $image);
    public function destroy($id);
}
