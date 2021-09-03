<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function advertisements()
	{
		return $this->belongsToMany(Advertisement::class, 'advertisement_tag', 'tag_id', 'advertisement_id')->withTimestamps();
	}
}
