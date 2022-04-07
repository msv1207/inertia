<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');

            // Relationships.
            $table->unsignedInteger('calendar_id')->nullable();
            $table->foreign('calendar_id')
                ->references('id')->on('calendars')
                ->onDelete('cascade');

            // Data.
            $table->string('event_id')->nullable()->unique();

            $table->bigInteger('google_id')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->boolean('allday')->default(false);

            // Timestamps.
//            $table->date('started_at');
            $table->timestamp('started_at');
            $table->timestamp('ended_at');
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
        Schema::dropIfExists('plans');
    }
};
