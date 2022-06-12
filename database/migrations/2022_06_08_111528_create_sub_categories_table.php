<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->string('translation_lang',10);
            $table->unsignedInteger('translation_of');
            $table->string('name',150);
            $table->string('slug',150)->nullable();
            $table->string('photo',100)->nullable();
            $table->tinyInteger('active')->default(1)->comment('2=>inactive 1=>active');
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
        Schema::dropIfExists('sub_categories');
    }
};
