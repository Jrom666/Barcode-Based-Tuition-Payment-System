<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Check first to avoid duplicate
            if (!Schema::hasColumn('users', 'usertype_id')) {
                $table->unsignedBigInteger('usertype_id')->nullable();
            }
    
            $table->foreign('usertype_id')->references('id')->on('usertype')->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['usertype_id']);
            $table->dropColumn('usertype_id');
        });
    }
};
