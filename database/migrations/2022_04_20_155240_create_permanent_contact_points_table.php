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
        Schema::create('permanent_contact_points', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("entity_name");
            $table->string("permanent_contact_point_name");
            $table->string("main_email_address");
            $table->string("secondary_email_address");
            $table->string("main_landline_phone_number");
            $table->string("secondary_landline_phone_number");
            $table->string("main_mobile_phone_number");
            $table->string("secondary_mobile_phone_number");
            $table->text("other_alternative_contacts");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permanent_contact_points');
    }
};
