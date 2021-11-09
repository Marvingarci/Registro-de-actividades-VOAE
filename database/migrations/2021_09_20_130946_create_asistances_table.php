<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistances', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('account_number');
            $table->string('email');
            $table->string('image');
            $table->uuid('event_id')->constrained('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('career');
            $table->time('start_asistance');
            $table->string('end_asistance')->nullable();
            $table->enum('status', ['entrada', 'salida', 'indefinido']);
            $table->timestamps();

            $table->unique(['event_id', 'account_number', 'email'], 'campos_unicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistances');
    }
}
