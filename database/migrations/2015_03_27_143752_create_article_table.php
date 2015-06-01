<?php

use UIS\Core\DB\Migrations\Migration;
use UIS\Core\DB\Schema\Blueprint;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->getSchemaBuilder()->create(
            'article',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 255);
                $table->text('body');
                $table->integer('author_id')->unsigned();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->getSchemaBuilder()->drop('article');
    }
}
