<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name', 128);
            $table->text('description');

            $table->boolean('rm_main');
            $table->boolean('add_main');

            $table->boolean('rm_origin');
            $table->boolean('add_origin');

            $table->boolean('rm_destin');
            $table->boolean('add_destin');

            $table->boolean('rm_void');
            $table->boolean('add_void');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_types');
    }
};
