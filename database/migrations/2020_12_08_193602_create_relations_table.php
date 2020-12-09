<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id();
            $table->string('rel_name',50)->nullable();
            $table->unsignedBigInteger('parent_node');
            $table->unsignedBigInteger('child_node');
            $table->timestamps();

            $table->foreign('parent_node')->references('id')->on('nodes');
            $table->foreign('child_node')->references('id')->on('nodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relations');
    }
}
