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
        Schema::create('asset_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("asset_id")->constrained()->cascadeOnDelete();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->string("ip");
            $table->enum("operation_type",array("CREATE","UPDATE","ADD_THREAT","EDIT_THREAT","REMOVE_THREAT", "ADD_CONTROL","REMOVE_CONTROL","TOGGLE_CONTROL_VALIDATION","TOGGLE_REMAINING_RISK_ACCEPTANCE"));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_logs');
    }
};
