<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->string('department');
            $table->string('service');
            $table->string('priority');
            $table->text('message');
            $table->text('reply')->nullable();
            $table->boolean('status')->default(true);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('agent_id')->references('id')->on('users');
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
