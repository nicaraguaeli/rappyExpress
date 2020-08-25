<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
           
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('group_id');
            $table->string('nombre');
            $table->longText('imagen');
            $table->enum('estado',[0,1])->default(0);
            $table->foreign('group_id')
            ->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
