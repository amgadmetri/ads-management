<?php

namespace App\Services;

use App\DTOs\CreateAdvertisementDTO;
use App\DTOs\FilterAdvertisementDTO;
use App\Models\Advertisement;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdvertisementService
{
    
    /**
    * @param CreateAdvertisementDTO $createAdvertisementDTO
    * @return Advertisement
    * @throws Exception
    */
    public function create_new_advertisement(CreateAdvertisementDTO $createAdvertisementDTO): Advertisement
    {
        $advertisement              = new Advertisement();
        $advertisement->title       = $createAdvertisementDTO->title;
        $advertisement->type        = $createAdvertisementDTO->type;
        $advertisement->description = $createAdvertisementDTO->description;
        $advertisement->advertiser  = $createAdvertisementDTO->advertiser;
        $advertisement->start_date  = $createAdvertisementDTO->start_date;
        $advertisement->save();
        if (!$advertisement) {
            throw new Exception("Error in create advertisement");
        }
        return $advertisement;
    }
    
    public function list_ads_with_filter(FilterAdvertisementDTO $filterAdvertisementDTO)
    {
        $list = (new Advertisement())->newQuery();
        
        if ($filterAdvertisementDTO->tag) {
            $tag = $filterAdvertisementDTO->tag;
            $list->whereHas("tags", function (Builder $query) use ($tag){
                $query->where('name', $tag);
            });
        }
        
        if ($filterAdvertisementDTO->category) {
            $category = $filterAdvertisementDTO->category;
            $list->whereHas("category", function (Builder $query) use ($category) {
                $query->where('name', $category);
            });
        }
        
        if ($filterAdvertisementDTO->advertiser_id) {
            $list->where('advertiser_id', $filterAdvertisementDTO->advertiser_id);
        }
        return $list->with(['category', 'tags'])->latest()->paginate();
    }

    public function get_tomorrow_ads()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        return Advertisement::where('start_date', $tomorrow)->with('advertiser')->get();
    }
    
}
