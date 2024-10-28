<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('packages');
            $table->enum('shippingType', ['boat', 'airplane', 'vehicule']);
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('origin_country_id')->constrained('origin_countries');
            $table->foreignId('destination_country_id')->constrained('destination_countries');
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
        Schema::dropIfExists('shippings');
    }
}
