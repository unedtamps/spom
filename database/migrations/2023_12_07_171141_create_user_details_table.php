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
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigInteger('user_id')->primary()->unsigned();
            $table->integer('meme_posted')->default(0)->unsigned();
            $table->integer('origin_created')->default(0)->unsigned();
            $table->integer('origin_denied')->default(0)->unsigned();
            $table->integer('origin_accepted')->default(0)->unsigned();
            $table->integer('meme_likes')->default(0)->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
