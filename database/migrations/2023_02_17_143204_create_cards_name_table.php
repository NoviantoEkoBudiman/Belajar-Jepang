<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards_name', function (Blueprint $table) {
            $table->id();
            $table->string('cards_name_name')->length(25);
            $table->foreignId('cards_name_group')->constrained('cards_group');
            $table->text('cards_name_description');
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
        Schema::dropIfExists('cards_name');
    }
};
