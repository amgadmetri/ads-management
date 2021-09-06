<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('advertiser_id');
            $table->enum('type', ['free', 'paid']);
            $table->string('title');
            $table->text('description');
            $table->date('start_date');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('advertiser_id')->references('id')->on('advertisers')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
