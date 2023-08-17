<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('company_id');
            $table->dropColumn('facility_id');
            $table->dropColumn('clearing_house_id');
            $table->dropColumn('insurance_company_id');

            $table->string('mobile')->nullable();
            $table->string('phone')->nullable()->change();
            $table->string('fax')->nullable()->change();
            $table->morphs('contactable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
        });
    }
}
