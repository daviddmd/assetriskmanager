<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_threat', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("control_id")->constrained()->restrictOnDelete();
            $table->foreignId("threat_id")->constrained()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('control_threat');
    }
};
