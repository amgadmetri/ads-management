<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementTagTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('advertisement_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisement_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            
            $table->foreign('advertisement_id')->references('id')->on('advertisements')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('tag_id')->references('id')->on('tags')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('advertisement_tag');
    }
}
