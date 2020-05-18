<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentInstructionWorkerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('sent_instruction_worker', function (Blueprint $table) {
            $table->unsignedInteger('sent_instruction_id');
            $table->foreign('sent_instruction_id', 'sent_instruction_id_fk_1393854')->references('id')->on('sent_instructions')->onDelete('cascade');
            $table->unsignedInteger('worker_id');
            $table->foreign('worker_id', 'worker_id_fk_1393854')->references('id')->on('workers')->onDelete('cascade');
        });
    }
}
