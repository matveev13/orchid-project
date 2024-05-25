<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn("season");
            $table->integer("category_id");
        });

       /*  Schema::table('products', function (Blueprint $table) {
            $table->integer("category_id"); */

            // $table->integer('category_id')->unsigned()->default(1);
            // $table->foreign('category_id')->references('id')->on('categories');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn("category_id");
            $table->char("season");
        });

       /*  Schema::table('products', function (Blueprint $table) {
            
        }); */
    }
};
