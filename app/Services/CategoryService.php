<?php

namespace App\Services;

use App\DTOs\CreateCategoryDTO;
use App\DTOs\EditCategoryDTO;
use App\Models\Category;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    
    /**
    * @param CreateCategoryDTO $createCategoryDTO
    * @return Category
    * @throws Exception
    */
    public function create_new_category(CreateCategoryDTO $createCategoryDTO): Category
    {
        $category        = new Category();
        $category->name = $createCategoryDTO->name;
        $category->save();
        if (!$category) {
            throw new Exception("Error in create category");
        }
        return $category;
    }
    
    /**
    * @return Category
    * @throws Exception
    */
    public function get_all_categories(): LengthAwarePaginator
    {
        return Category::latest()->paginate(10);
    }
    
    
    /**
    * @param int $id
    * @return Category
    * @throws Exception
    */
    public function get_category_by_id($id): Category
    {
        return Category::find($id);
    }   
    
    /**
    * @param int $id
    * @return boolean
    * @throws Exception
    */
    public function is_category_exists($id): bool
    {
        return Category::where('id', $id)->exists();
    }
    
    /**
    * @param Category $category
    * @param EditCategoryDTO $editCategoryDTO
    * @return Category
    * @throws Exception
    */
    public function edit_category(Category $category, EditCategoryDTO $editCategoryDTO): Category
    {
        $category->name = $editCategoryDTO->name;
        $category->save();
        if (!$category) {
            throw new Exception("Error while editing category");
        }
        return $category;
    }    
    
    /**
    * @param Category $category
    * @return Category
    * @throws Exception
    */
    public function delete_category(Category $category): bool
    {
        return $category->delete();
    }
}
