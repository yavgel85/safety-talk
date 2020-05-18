<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentInstructionsTable extends Migration
{
    public function up()
    {
        Schema::create('sent_instructions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->datetime('validation_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
