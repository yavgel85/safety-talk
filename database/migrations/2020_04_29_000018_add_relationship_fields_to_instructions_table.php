<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInstructionsTable extends Migration
{
    public function up()
    {
        Schema::table('instructions', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1393263')->references('id')->on('users');
            $table->unsignedInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_1393264')->references('id')->on('companies');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_1393268')->references('id')->on('teams');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_1393274')->references('id')->on('categories');
        });

    }
}
