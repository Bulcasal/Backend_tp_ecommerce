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
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('price')->nullable();

            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0);
            }
            if (!Schema::hasColumn('products', 'category_id')) {
                $table->foreignId('category_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->unique();
            }
            if (!Schema::hasColumn('products', 'image_path')) {
                $table->string('image_path')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'description',
                'price',
                'stock',
                'category_id',
                'slug',
                'image_path'
            ]);
        });
    }
};
