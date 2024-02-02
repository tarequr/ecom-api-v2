<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;
use App\Repositories\UnitRepository;

class UnitController extends Controller
{
    protected $unit;

    public function __construct(UnitRepository $unitRepository)
    {
        $this->unit = $unitRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->cannot('units.index')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        $data =  $this->unit->all();
        return UnitResource::collection($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        if (auth()->user()->cannot('units.create')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return  $this->unit->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (auth()->user()->cannot('units.show')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        $item = $this->unit->find($id);
        return new UnitResource($item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, string $id)
    {
        if (auth()->user()->cannot('units.update')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return  $this->unit->update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->cannot('units.delete')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return $this->unit->destroy($id);
    }
}
