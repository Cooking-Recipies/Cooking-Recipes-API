<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{

    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->uuid("id");
            $table->unsignedBigInteger("user_id");
            $table->string("path");
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")
                ->onDelete("cascade");
        });
    }

    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
