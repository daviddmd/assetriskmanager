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
        Schema::table("asset_threats", function (Blueprint $table) {
            $table->unique(["asset_id", "threat_id"]);
        });
        Schema::table("asset_threat_controls", function (Blueprint $table) {
            $table->unique(["asset_threat_id", "control_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("asset_threats", function (Blueprint $table) {
            $table->dropUnique(["asset_id", "threat_id"]);
        });
        Schema::table("asset_threat_controls", function (Blueprint $table) {
            $table->dropUnique(["asset_threat_id", "control_id"]);
        });
    }
};
