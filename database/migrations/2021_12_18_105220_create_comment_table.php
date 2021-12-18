<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('conn_proyek')->hasTable('comment')){
            Schema::connection('conn_proyek')->create('comment', function (Blueprint $table) {
                $table->id("id");
                $table->string("id_user");
                $table->string("id_manga");
                $table->text("content");
                $table->timestamps();
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
        Schema::dropIfExists('comment');
    }
}
