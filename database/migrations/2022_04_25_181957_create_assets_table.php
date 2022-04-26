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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->foreignId("type")->references("id")->on("asset_types")->restrictOnDelete();
            $table->foreignId("manager")->references("id")->on("users")->restrictOnDelete();
            $table->text("description");
            $table->string("sku");
            $table->string("manufacturer");
            $table->string("location");
            $table->enum("manufacturer_contract_type", ["NONE", "WARRANTY", "MAINTENANCE", "SUPPORT"])->default("NONE");
            $table->date("manufacturer_contract_beginning_date")->nullable();
            $table->date("manufacturer_contract_ending_date")->nullable();
            $table->string("manufacturer_contract_provider");
            $table->string("mac_address");
            $table->string("ip_address");
            $table->integer("availability_appreciation");
            $table->integer("integrity_appreciation");
            $table->integer("confidentiality_appreciation");
            $table->boolean("export")->default(true);
            $table->boolean("active")->default(true);
            //$table->enum("status", ["INITIAL","AWAITS_THREATS", "AWAITS_TREATMENTS", "AWAITS_VALIDATION", "AWAITS_CONFIRMATION","COMPLETE"])->default("INITIAL");


        });
        Schema::table('assets', function (Blueprint $table) {
            $table->foreignId('links_to')->nullable()->references('id')->on('assets')->restrictOnDelete();
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
