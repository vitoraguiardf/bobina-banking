<?php

use App\Models\User;
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
        Schema::create('coil_storages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('creator_user_id');
            $table->foreign('creator_user_id')->references('id')->on('users');

            $table->unsignedBigInteger('owner_user_id');
            $table->foreign('owner_user_id')->references('id')->on('users');

            $table->string('name', 128);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coil_storages');
    }
};
