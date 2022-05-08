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
        Schema::create('asset_threats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("asset_id")->constrained()->cascadeOnDelete();
            $table->foreignId("threat_id")->constrained()->restrictOnDelete();
            $table->integer("probability")->default(0);
            $table->integer("confidentiality_impact")->default(0);
            $table->integer("availability_impact")->default(0);
            $table->integer("integrity_impact")->default(0);
            $table->integer("residual_risk")->default(0);
            $table->boolean("residual_risk_accepted")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_threats');
    }
};
