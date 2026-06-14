<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Removed — images are now inline in Markdown content
    }

    public function down(): void
    {
        Schema::create('origin_examples', function (Blueprint $table) {
            $table->string('example', 64);
            $table->bigInteger('origin_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('origin_id')->references('id')->on('origin_memes')->cascadeOnDelete();
        });
    }
};
