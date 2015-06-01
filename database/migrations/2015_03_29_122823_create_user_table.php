<?php

use UIS\Core\DB\Migrations\Migration;
use UIS\Core\DB\Schema\Blueprint;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->getSchemaBuilder()->create(
            'user',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->string('email', 255);
                $table->string('password', 255);
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
        $this->getSchemaBuilder()->drop('user');
    }
}
