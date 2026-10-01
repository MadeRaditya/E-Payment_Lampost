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
            $table->enum('placement_type', ['online', 'offline'])
                ->nullable()
                ->after('category');
            $table->longText('signature_data')->nullable()->after('payment_preference');
            $table->timestamp('signed_at')->nullable()->after('signature_data');
            $table->string('signed_by_name')->nullable()->after('signed_at');
            $table->string('signed_ip', 45)->nullable()->after('signed_by_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'placement_type',
                'signature_data',
                'signed_at',
                'signed_by_name',
                'signed_ip',
            ]);
        });
    }
};
