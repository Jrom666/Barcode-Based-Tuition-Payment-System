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
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('term', ['Prelim', 'Midterms', 'Prefinal', 'Finals'])->after('amount');
            $table->enum('status', ['Partial','Paid', 'Pending', 'Cancelled'])->default('Paid')->after('term');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['term', 'status']);
        });
    }
};
