<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\EditTagRequest;
use App\Http\Resources\TagsResource;
use App\Services\TagService;
use Exception;

class TagController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return TagsResource
    */
    public function index(TagService $tagService)
    {
        $tags = $tagService->get_all_tags();
        return TagsResource::collection($tags);
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  CreateTagRequest  $request
    * @param  TagService  $tagService
    * @return \Illuminate\Http\Response
    */
    public function store(CreateTagRequest $request, TagService $tagService)
    {
        try {
            $tag = $tagService->create_new_tag($request->getDTO());
            if ($tag) {
                return response()->json([
                    'message' => "tag created successfully"
                ]);
            }
            return response()->json([
                'message' => "Can not create tag"
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
    * @param  TagService  $tagService
    * @return \Illuminate\Http\Response
    */
    public function show($id, TagService $tagService)
    {
        if ($tagService->is_tag_exists($id)) {
            
            $tag = $tagService->get_tag_by_id($id);
            return new TagsResource($tag);
        }
        
        return response()->json([
            'message' => "Can not find tag in id {$id} "
        ], 404);
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  EditTagRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function edit(EditTagRequest $request, TagService $tagService, $id)
    {
        if ($tagService->is_tag_exists($id)) {
            $tag = $tagService->get_tag_by_id($id);
            $response = $tagService->edit_tag($tag, $request->getDTO());
            if ($response) {
                return response()->json([
                    'message' => "Tag Edited successfully"
                ]);
            }
        }
        return response()->json([
            'message' => "Can not find tag in id {$id} "
        ], 404);
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  TagService  $tagService
    * @return \Illuminate\Http\Response
    */
    public function destroy(TagService $tagService, $id)
    {
        if ($tagService->is_tag_exists($id)) {
            $tag = $tagService->get_tag_by_id($id);
            $response = $tagService->delete_tag($tag);
            if ($response) {
                return response()->json([
                    'message' => "Tag deleted successfully"
                ]);
            }
        }
        return response()->json([
            'message' => "Can not find tag in id {$id} "
        ], 404);
    }
}
