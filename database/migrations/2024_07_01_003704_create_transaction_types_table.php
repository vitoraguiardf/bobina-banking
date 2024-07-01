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

            $table->unsignedBigInteger("user_id");

            $table->string('name', 128);
            $table->text('description');

            $table->boolean('rm_main')->default(false);
            $table->boolean('add_main')->default(false);

            $table->boolean('rm_origin')->default(false);
            $table->boolean('add_origin')->default(false);

            $table->boolean('rm_destin')->default(false);
            $table->boolean('add_destin')->default(false);

            $table->boolean('rm_void')->default(false);
            $table->boolean('add_void')->default(false);

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
