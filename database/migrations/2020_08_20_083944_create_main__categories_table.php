<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main__categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('translation_lang');
            $table->unsignedInteger('translation_of');
            $table->string("name");
            $table->string("slug")->nullable();
            $table->string("photo")->nullable();
            $table->tinyInteger("active")->default(1); // 1 => active , 0 => inactive
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
        Schema::dropIfExists('main__categories');
    }
}
