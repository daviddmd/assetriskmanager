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
        Schema::create('security_officers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("entity_name");
            $table->string("name");
            $table->string("role");
            $table->string("email_address");
            $table->string("landline_phone_number");
            $table->string("mobile_phone_number");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('security_officers');
    }
};
