<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclarationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declarations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('affection_id')->constrained('affectations')->onDelete('cascade')->onUpdate('cascade');
            $table->string('test_signal');
            $table->binary('image_test_signal');
            $table->binary('image_pbo_before');
            $table->binary('image_pbo_after');
            $table->binary('image_pbi_after');
            $table->binary('image_pbi_before');
            $table->binary('image_splitter');
            $table->string('type_passage');
            $table->binary('image_passage_1');
            $table->binary('image_passage_2');
            $table->binary('image_passage_3');
            $table->string('sn_telephone');
            $table->string('nbr_jarretieres');
            $table->string('cable_metre');
            $table->string('pto');
            $table->foreignId('routeur_id')->constrained('routeurs')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('declarations');
    }
}
