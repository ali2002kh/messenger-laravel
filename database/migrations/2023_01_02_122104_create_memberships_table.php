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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->set('role', ['owner', 'member']);
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('group_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('group_id')->references('id')
            ->on('groups')->onDelete('cascade')
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
        Schema::dropIfExists('memberships');
    }
};
