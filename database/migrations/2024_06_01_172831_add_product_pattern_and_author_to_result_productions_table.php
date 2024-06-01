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
        Schema::table('result_productions', function (Blueprint $table) {
            $table->string('product')->nullable()->after('id');
            $table->string('pattern')->nullable()->after('product');
            $table->string('author')->nullable()->after('group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('result_productions', function (Blueprint $table) {
            $table->dropColumn('product');
            $table->dropColumn('pattern');
            $table->dropColumn('author');
        });
    }
};
