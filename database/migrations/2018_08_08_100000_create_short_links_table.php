<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('short_links', static function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('destination_url')->nullable();
            $table->string('url_key')->unique();
            $table->boolean('single_use')->default(false)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('short_links');
    }
};
