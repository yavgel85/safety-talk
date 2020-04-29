<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkersListsTable extends Migration
{
    public function up()
    {
        Schema::table('workers_lists', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_1393680')->references('id')->on('teams');
        });

    }
}
