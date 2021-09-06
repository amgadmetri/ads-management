<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advertisements\FilterAdvertisementsRequest;
use App\Http\Resources\AdvertisementsResource;
use App\Models\Advertisement;
use App\Services\AdvertisementService;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(AdvertisementService $advertisementService, FilterAdvertisementsRequest $request)
    {
        $advertisements = $advertisementService->list_ads_with_filter($request->getDTO());
        return AdvertisementsResource::collection($advertisements);
    }

    
}
