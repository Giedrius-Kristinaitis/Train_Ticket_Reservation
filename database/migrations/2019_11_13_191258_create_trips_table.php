<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('train_id')->nullable(false)->unsigned();
            $table->bigInteger('schedule_id')->nullable(false)->unsigned();
            $table->foreign('train_id')
                ->references('id')
                ->on('trains')
                ->onDelete('cascade');
            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedules')
                ->onDelete('cascade');
            $table->text('from')->nullable(false);
            $table->text('to')->nullable(false);
            $table->dateTime('date')->nullable(false);
            $table->integer('reserved_tickets')->nullable(false)->unsigned();
            $table->integer('total_tickets')->nullable(false)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
}
