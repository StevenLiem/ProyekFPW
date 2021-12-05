<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('conn_proyek')->hasTable('users')){
            Schema::connection('conn_proyek')->create('users', function (Blueprint $table) {
                $table->id("id");
                $table->string("username", 50);
                $table->text("password");
                $table->string("email", 255);
                $table->enum("status", ["active", "banned"])->default("active");
                $table->enum("role", ["admin", "user"])->default("user");
                $table->enum("privilege", ["regular", "premium"])->default("regular");
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
