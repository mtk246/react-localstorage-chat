<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('sex');
            $table->dropColumn('lastName');
            $table->dropColumn('firstName');
            $table->dropColumn('middleName');
            $table->dropColumn('available');
            $table->dropColumn('img_profile');
            $table->dropColumn('ssn');
            $table->dropColumn('dateOfBirth');

            $table->string('userkey')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamp('last_login')->nullable();
            $table->foreignId('profile_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        });
    }
}
