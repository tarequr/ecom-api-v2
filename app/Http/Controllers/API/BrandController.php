<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Repositories\BrandRepository;

class BrandController extends Controller
{
    protected $brand;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brand = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->cannot('brands.index')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        $data =  $this->brand->all();
        return BrandResource::collection($data);
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
    public function store(BrandRequest $request)
    {
        if (auth()->user()->cannot('brands.create')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return  $this->brand->create($request->validated(), $request->hasFile('image') ? $request->file('image') : null);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (auth()->user()->cannot('brands.show')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        $item = $this->brand->find($id);
        return new BrandResource($item);
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
    public function update(BrandRequest $request, string $id)
    {
        if (auth()->user()->cannot('brands.update')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return  $this->brand->update($request->validated(), $id ,$request->hasFile('image') ? $request->file('image') : null);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->cannot('brands.delete')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return $this->brand->destroy($id);
    }
}
