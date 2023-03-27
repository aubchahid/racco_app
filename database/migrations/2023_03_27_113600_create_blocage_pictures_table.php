<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocagePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocage_pictures', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->uniqid();
            $table->foreignId('blocage_id')->nullable()->constrained('blocages')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image',800);
            $table->binary('image_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocage_pictures');
    }
}
