<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('type');
            $table->string('name');
            $table->string('address');
            $table->string('lat');
            $table->string('lng');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('plaque_id')->constrained('plaques')->onDelete('cascade')->onUpdate('cascade');
            $table->string('phone_no');
            $table->string('debit');
            $table->string('sip');
            $table->foreignId('technicien_id')->nullable()->constrained('techniciens')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status')->default('Saisie');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('clients');
    }
}
