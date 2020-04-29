<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersListsTable extends Migration
{
    public function up()
    {
        Schema::create('workers_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('is_listed')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
