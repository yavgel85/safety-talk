<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSentInstructionsTable extends Migration
{
    public function up()
    {
        Schema::table('sent_instructions', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1393850')->references('id')->on('users');
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_1393851')->references('id')->on('statuses');
            $table->unsignedInteger('workers_list_id')->nullable();
            $table->foreign('workers_list_id', 'workers_list_fk_1393852')->references('id')->on('workers_lists');
            $table->unsignedInteger('instruction_id')->nullable();
            $table->foreign('instruction_id', 'instruction_fk_1393853')->references('id')->on('instructions');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_1393858')->references('id')->on('teams');
        });
    }
}
