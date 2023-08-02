<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organisation_id')->unsigned();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone_fixe');
            $table->string('service');
            $table->string('fonction');
            $table->string('cle');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('contacts', function($table) {
            $table->foreign('organisation_id')->references('id')->on('organisations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
