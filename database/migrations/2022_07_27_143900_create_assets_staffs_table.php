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
        // Schema::create('assets_staffs', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('staff_id');
        //     $table->foreign('staff_id')
        //         ->references('staff_id')->on('staff');
        //     $table->foreignId('asset_id')->constrained('assets');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets_staffs');
    }
};
