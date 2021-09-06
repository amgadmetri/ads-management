<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\EditCategoryRequest;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return CategoriesResource
    */
    public function index(CategoryService $categoryService)
    {
        $categories = $categoryService->get_all_categories();
        return CategoriesResource::collection($categories);
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  CreateCategoryRequest  $request
    * @param  CategoryService  $categoryService
    * @return \Illuminate\Http\Response
    */
    public function store(CreateCategoryRequest $request, CategoryService $categoryService)
    {
        try {
            $category = $categoryService->create_new_category($request->getDTO());
            if ($category) {
                return response()->json([
                    'message' => "Category created successfully"
                ]);
            }
            return response()->json([
                'message' => "Can not create category"
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'code'    => $exception->getCode(),
            ]);
        }
    }
    
    /**
    * Display the specified resource.
    * @param  int  $id
    * @param  CategoryService  $categoryService
    * @return \Illuminate\Http\Response
    */
    public function show($id, CategoryService $categoryService)
    {
        if ($categoryService->is_category_exists($id)) {
            
            $category = $categoryService->get_category_by_id($id);
            return new CategoriesResource($category);
        }
        
        return response()->json([
            'message' => "Can not find category in id {$id} "
        ], 404);
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  EditCategoryRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function edit(EditCategoryRequest $request, CategoryService $categoryService, $id)
    {
        if ($categoryService->is_category_exists($id)) {
            $category = $categoryService->get_category_by_id($id);
            $response = $categoryService->edit_category($category, $request->getDTO());
            if ($response) {
                return response()->json([
                    'message' => "Category Edited successfully"
                ]);
            }
        }
        return response()->json([
            'message' => "Can not find category in id {$id} "
        ], 404);
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  CategoryService  $categoryService
    * @return \Illuminate\Http\Response
    */
    public function destroy(CategoryService $categoryService, $id)
    {
        if ($categoryService->is_category_exists($id)) {
            $category = $categoryService->get_category_by_id($id);
            $response = $categoryService->delete_category($category);
            if ($response) {
                return response()->json([
                    'message' => "Category deleted successfully"
                ]);
            }
        }
        return response()->json([
            'message' => "Can not find category in id {$id} "
        ], 404);
    }
}
