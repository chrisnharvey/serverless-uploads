<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id');

            $table->string('path')->nullable();
            $table->string('name')->nullable();
            $table->integer('size')->nullable();
            $table->string('mimetype')->nullable();
            $table->json('types')->nullable();
            $table->integer('min_size')->nullable();
            $table->integer('max_size')->nullable();
            $table->integer('file_expires_in');
            $table->timestamp('link_expires');
            $table->timestamp('file_expires')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
