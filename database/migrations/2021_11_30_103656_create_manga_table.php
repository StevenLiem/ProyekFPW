<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMangaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('conn_proyek')->hasTable('manga')){
            Schema::connection('conn_proyek')->create('manga', function (Blueprint $table) {
                $table->id("id");
                $table->string("title", 255);
                $table->integer("id_author");
                $table->integer("id_artist");
                $table->text("synopsis");
                $table->integer("total_page");
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('manga');
    }
}
