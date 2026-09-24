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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('advertiser_name')->nullable()->after('description');
            $table->string('advertiser_contact')->nullable()->after('advertiser_name');
            $table->string('ad_slot')->nullable()->after('advertiser_contact'); 
            $table->integer('ad_duration_days')->nullable()->after('ad_slot');
            $table->date('ad_start_date')->nullable()->after('ad_duration_days'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'advertiser_name', 'advertiser_contact', 
                'ad_slot', 'ad_duration_days', 'ad_start_date'
            ]);
        });
    }
};
