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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->bigInteger('sender')->unsigned()->index();
            $table->bigInteger('receiver')->unsigned()->index();
            $table->timestamps();

            $table->foreign('sender')->references('id')
            ->on('users')->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('receiver')->references('id')
            ->on('users')->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
};
