<?php

namespace App\Repositories;

interface UnitInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update(array $data, $id);
    public function destroy($id);
}
