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

    public function create(CategoryRequest $request)
    {
        if (auth()->user()->cannot('categories.create')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return  $this->category->create($request->validated());
    }

    public function find($id)
    {
        if (auth()->user()->cannot('categories.show')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        $item = $this->category->find($id);
        return new CategoryResource($item);
    }

    public function update(CategoryRequest $request, $id)
    {
        if (auth()->user()->cannot('categories.update')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return  $this->category->update($request->validated(), $id);
    }

    public function destroy($id)
    {
        if (auth()->user()->cannot('categories.destroy')) {
            return response()->json([
                'message' => 'Unothorized, you don\'t have access'
            ], 403);
        }

        return $this->category->destroy($id);
    }

}
