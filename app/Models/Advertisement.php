<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class, 'advertiser_id');
    }

    public function tags()
	{
		return $this->belongsToMany(Tag::class, 'advertisement_tag', 'advertisement_id', 'tag_id')->withTimestamps();
	}
}
