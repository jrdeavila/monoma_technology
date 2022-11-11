<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $collection) {
            $collection->index('username', 'username_', 'unique', ['unique' => true]);
        });

        Schema::create('leads', function (Blueprint $collection) {
            $collection->index('name', 'name_', 'unique', ['unique' => true]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $collection) {
            $collection->dropIndex('username_');
        });

        Schema::table('leads', function (Blueprint $collection) {
            $collection->dropIndex('name_');
        });
    }
};
