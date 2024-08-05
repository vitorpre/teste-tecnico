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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("account_id")->constrained(
                table: 'accounts', indexName: 'payment_account_id'
            );
            $table->unsignedInteger("account_number");
            $table->char("payment_method", length: 1)->comment('P > Pix, C > Crédito, D > Débito'); ;
            $table->float("base_value");
            $table->float("fee_value");
            $table->float("value");
            $table->timestamps();

            $table->index('account_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
