<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apps_countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 2);
            $table->string('country_name', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apps_countries');
    }
};
