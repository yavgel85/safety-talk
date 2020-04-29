<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerWorkersListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('worker_workers_list', function (Blueprint $table) {
            $table->unsignedInteger('workers_list_id');
            $table->foreign('workers_list_id', 'workers_list_id_fk_1393689')->references('id')->on('workers_lists')->onDelete('cascade');
            $table->unsignedInteger('worker_id');
            $table->foreign('worker_id', 'worker_id_fk_1393689')->references('id')->on('workers')->onDelete('cascade');
        });

    }
}
