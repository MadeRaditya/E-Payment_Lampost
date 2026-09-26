<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE invoices MODIFY COLUMN status ENUM('draft', 'unpaid', 'paid', 'failed', 'expired') DEFAULT 'unpaid'");

        Schema::table('invoices', function (Blueprint $table) {
            $table->string('category')->nullable()->after('description');
            $table->string('subcategory')->nullable()->after('category');
            $table->string('ad_title')->nullable()->after('subcategory');
            $table->string('ad_format')->nullable()->after('ad_title');
            $table->text('ad_text')->nullable()->after('ad_format');

            $table->json('media_files')->nullable()->after('ad_text');

            $table->string('billing_name')->nullable()->after('media_files');
            $table->string('billing_npwp_nik')->nullable()->after('billing_name');
            $table->string('billing_email')->nullable()->after('billing_npwp_nik');
            $table->string('billing_phone')->nullable()->after('billing_email');
            $table->text('billing_address')->nullable()->after('billing_phone');

            $table->string('payment_preference')->nullable()->after('billing_address');
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'category', 'subcategory', 'ad_title', 'ad_format',
                'ad_text', 'media_files', 'billing_name', 'billing_npwp_nik',
                'billing_email', 'billing_phone', 'billing_address', 'payment_preference',
            ]);
        });
    }
};