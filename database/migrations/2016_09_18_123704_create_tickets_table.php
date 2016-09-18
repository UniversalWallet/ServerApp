<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('address')->nullable();
            $table->string('event')->nullable();
            $table->string('place')->nullable();
            $table->string('seat')->nullable();
            $table->string('price')->nullable();
            $table->string('vendor_id')->nullable();
            $table->string('partner_id')->nullable();
            $table->string('partner_name')->nullable();
            $table->string('scope')->nullable();
            $table->time('time_at')->nullable();
            $table->boolean('verified')->default(0);
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
        Schema::dropIfExists('tickets');
    }
}
