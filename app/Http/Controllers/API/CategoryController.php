<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->cannot('categories.index')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        $data =  $this->category->all();
        return CategoryResource::collection($data);
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
    public function store(CategoryRequest $request)
    {
        if (auth()->user()->cannot('categories.create')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return  $this->category->create($request->validated(), $request->hasFile('image') ? $request->file('image') : null);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (auth()->user()->cannot('categories.show')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        $item = $this->category->find($id);
        return new CategoryResource($item);
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
    public function update(CategoryRequest $request, string $id)
    {
        if (auth()->user()->cannot('categories.update')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return  $this->category->update($request->validated(), $id ,$request->hasFile('image') ? $request->file('image') : null);
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

        return $this->category->destroy($id);
    }

}
