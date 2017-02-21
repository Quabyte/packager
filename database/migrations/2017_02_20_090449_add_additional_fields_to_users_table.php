<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('surname')->after('name');
            $table->text('address')->after('remember_token');
            $table->integer('postal_code')->after('address');
            $table->string('country')->after('postal_code');
            $table->string('telephone')->after('country');
            $table->string('tc_id')->after('telephone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('surname');
            $table->dropColumn('address');
            $table->dropColumn('postal_code');
            $table->dropColumn('country');
            $table->dropColumn('telephone');
            $table->dropColumn('tc_id');
        });
    }
}
