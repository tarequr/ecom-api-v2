<?php

namespace App\Repositories;

use App\Models\Unit;
use Illuminate\Support\Str;

class UnitRepository implements UnitInterface
{
    protected $unit;

    public function __construct(Unit $unit)
    {
        $this->unit = $unit;
    }

    public function all()
    {
        return $this->unit->all();
    }

    public function find($id)
    {
        return $this->unit->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->unit->create($data);
    }

    public function update(array $data, $id)
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->unit->findOrFail($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->unit->findOrFail($id)->delete();
    }
}
