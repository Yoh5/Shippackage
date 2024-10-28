<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('trackingNumber');
            $table->float('weight');
            $table->float('height');
            $table->float('width');
            $table->float('length');
            $table->float('value');
            $table->enum('type', ['express', 'normal']);
            $table->date('arrivalDate');
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
        Schema::dropIfExists('packages');
    }
}
