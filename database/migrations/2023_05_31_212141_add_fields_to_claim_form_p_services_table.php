<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_form_p_services', function (Blueprint $table) {
            $table->unsignedBigInteger('revenue_code_id')->nullable();
            $table->foreign('revenue_code_id', 'cs_revenue_code_id_fk')
                ->references('id')
                ->on('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->decimal('total_charge', 8, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('claim_form_p_services', function (Blueprint $table) {
            $table->dropForeign('cs_revenue_code_id_fk');

            $table->dropColumn('revenue_code_id');
            $table->dropColumn('total_charge');
        });
    }
};
