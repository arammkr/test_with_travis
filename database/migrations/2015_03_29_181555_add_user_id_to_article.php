<?php

use UIS\Core\DB\Schema\Blueprint;
use UIS\Core\DB\Migrations\Migration;

class AddUserIdToArticle extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $this->getSchemaBuilder()->table(
            'article',
            function (Blueprint $table) {
                $table->integer('user_id');
                $table->index('user_id');
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
		$this->getSchemaBuilder()->table(
            'article',
            function (Blueprint $table) {
                $table->dropColumn('user_id');
            }
        );
	}

}
