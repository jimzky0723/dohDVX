<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileDengvaxia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('dengvaxia_profiles')){
            return true;
        }
        Schema::create('dengvaxia_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification_number')->nullable();
            $table->string('fac_province')->nullable();
            $table->string('fac_muncity')->nullable();
            $table->string('facility_name')->nullable();
            $table->string('lname')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('house_number')->nullable();
            $table->string('barangay_id')->nullable();
            $table->string('muncity_id')->nullable();
            $table->string('province_id')->nullable();
            $table->string('barangay')->nullable();
            $table->string('muncity')->nullable();
            $table->string('province')->nullable();
            $table->string('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('first_dose_screened')->nullable();
            $table->string('first_dose_date_given')->nullable();
            $table->string('first_dose_age')->nullable();
            $table->string('validation')->nullable();
            $table->string('one_def')->nullable();
            $table->string('two_def')->nullable();
            $table->string('three_def')->nullable();
            $table->string('four_def')->nullable();
            $table->string('five_def')->nullable();
            $table->string('six_def')->nullable();
            $table->string('seven_def')->nullable();
            $table->string('eight_def')->nullable();
            $table->string('nine_def')->nullable();
            $table->string('ten_def')->nullable();
            $table->string('eleven_def')->nullable();
            $table->string('twelve_def')->nullable();
            $table->string('first_dose_lotNum')->nullable();
            $table->string('first_dose_batchNum')->nullable();
            $table->string('first_dose_expiration')->nullable();
            $table->string('first_dose_aefi')->nullable();
            $table->string('remarks')->nullable();
            $table->string('second_dose_screened')->nullable();
            $table->string('second_dose_date_given')->nullable();
            $table->string('second_dose_age')->nullable();
            $table->string('second_dose_reasons_refused')->nullable();
            $table->string('tsekap_id');
            $table->string('status')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('dengvaxia_profiles');
    }
}
