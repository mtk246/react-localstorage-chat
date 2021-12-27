<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date("DOB");
            $table->string("sex",1);
            $table->string("lastName",20);
            $table->string("firstName",20);
            $table->string("middleName",20);
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
            $table->dropColumn("DOB");
            $table->dropColumn("sex");
            $table->dropColumn("lastName");
            $table->dropColumn("firstName");
            $table->dropColumn("middleName");
        });
    }
}
