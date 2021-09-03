<?php

namespace App\Services;

use App\DTOs\CreateAdvertisementDTO;
use App\Models\Advertisement;
use Exception;

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
        $advertisement->description = $createAdvertisementDTO->description;
        $advertisement->advertiser  = $createAdvertisementDTO->advertiser;
        $advertisement->start_date  = $createAdvertisementDTO->start_date;
        $advertisement->save();
        if (!$advertisement) {
            throw new Exception("Error in create advertisement");
        }
        return $advertisement;
    }
    
    
}
