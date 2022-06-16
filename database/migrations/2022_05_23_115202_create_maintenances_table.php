<?php

use App\Enums\MaintenanceStatus;
use App\Enums\Priority;
use App\Enums\ServiceType;
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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('description')->nullable();
            $table->string('status')->default(MaintenanceStatus::getKey(MaintenanceStatus::Pending));
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id')
                ->references('id')->on('assets');
            $table->string('service_type')->default(ServiceType::getKey(ServiceType::Internal));
            $table->string('staff_id')->nullable();
            $table->string('serviced_by')->nullable();
            $table->string('repaired_at')->nullable();
            $table->string('comment')->nullable();
            $table->string('priority')->default(Priority::getKey(Priority::Normal));
            $table->string('image')->nullable();
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
        Schema::dropIfExists('maintenances');
    }
};
