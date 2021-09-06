<?php

namespace App\DTOs;

class CreateAdvertisementDTO extends BaseDTO
{

    public string $title;
    public string $type;
    public string $description;
    public int $advertiser;
    public string $start_date;
}
