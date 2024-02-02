<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Repositories\SubCategoryRepository;

class SubCategoryController extends Controller
{
    protected $subCategory;

    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategory = $subCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->cannot('sub-categories.index')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        $data =  $this->subCategory->all();
        return SubCategoryResource::collection($data);
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
    public function store(SubCategoryRequest $request)
    {
        if (auth()->user()->cannot('sub-categories.create')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return  $this->subCategory->create($request->validated(), $request->hasFile('image') ? $request->file('image') : null);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (auth()->user()->cannot('sub-categories.show')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        $item = $this->subCategory->find($id);
        return new SubCategoryResource($item);
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
    public function update(SubCategoryRequest $request, string $id)
    {
        if (auth()->user()->cannot('sub-categories.update')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return  $this->subCategory->update($request->validated(), $id ,$request->hasFile('image') ? $request->file('image') : null);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->cannot('categories.delete')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return $this->subCategory->destroy($id);
    }
}
