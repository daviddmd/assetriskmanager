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
        Schema::create('asset_threat_controls', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("asset_threat_id")->constrained()->cascadeOnDelete();
            $table->foreignId("control_id")->constrained()->restrictOnDelete();
            $table->boolean("validated")->default(false);
            $table->enum("control_type", ["MITIGATE", "TRANSFER", "ACCEPT"])->default("ACCEPT");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_threat_controls');
    }
};
