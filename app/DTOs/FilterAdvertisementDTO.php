<?php

namespace App\DTOs;

class FilterAdvertisementDTO extends BaseDTO
{

    public ?string $tag;
    public ?string $category;
    public int $advertiser_id;
}
