<?php

namespace App\Services;

use App\DTOs\CreateTagDTO;
use App\DTOs\EditTagDTO;
use App\Models\Tag;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class TagService
{
    
    /**
    * @param CreateTagDTO $createTagDTO
    * @return Tag
    * @throws Exception
    */
    public function create_new_tag(CreateTagDTO $createTagDTO): Tag
    {
        $tag        = new Tag();
        $tag->name = $createTagDTO->name;
        $tag->save();
        if (!$tag) {
            throw new Exception("Error in create Tag");
        }
        return $tag;
    }
    
    /**
    * @return Tag
    * @throws Exception
    */
    public function get_all_tags(): LengthAwarePaginator
    {
        return Tag::latest()->paginate(10);
    }
    
    
    /**
    * @param int $id
    * @return Tag
    * @throws Exception
    */
    public function get_tag_by_id($id): Tag
    {
        return Tag::find($id);
    }   
    
    /**
    * @param int $id
    * @return boolean
    * @throws Exception
    */
    public function is_tag_exists($id): bool
    {
        return Tag::where('id', $id)->exists();
    }
    
    /**
    * @param Tag $tag
    * @param EditTagDTO $editTagDTO
    * @return Tag
    * @throws Exception
    */
    public function edit_tag(Tag $tag, EditTagDTO $editTagDTO): Tag
    {
        $tag->name = $editTagDTO->name;
        $tag->save();
        if (!$tag) {
            throw new Exception("Error while editing tag");
        }
        return $tag;
    }    
    
    /**
    * @param Tag $tag
    * @return Tag
    * @throws Exception
    */
    public function delete_tag(Tag $tag): bool
    {
        return $tag->delete();
    }
}
