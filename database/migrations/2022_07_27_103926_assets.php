<?php

use App\Enums\Disposition;
use App\Enums\Functionality;
use App\Enums\Status;
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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('tag')->nullable();
            $table->string('disposition')->default(Disposition::getKey(Disposition::Issued));
            $table->string('status')->default(Status::getKey(Status::Store));
            $table->string('user_id');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')
                ->references('id')->on('departments');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')
                ->references('id')->on('locations');
            $table->string('category_id');
            $table->string('functionality')->default(Functionality::getKey(Functionality::Operational));
            $table->string('note')->nullable();
            $table->json('others')->nullable();
            $table->string('image')->nullable();
            $table->SoftDeletes();
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
        Schema::dropIfExists('assets');
    }
};
