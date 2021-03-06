<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('link', 255)->nullable();
            $table->string('slug', 255);
            $table->string('author', 100)
                ->default('Admin');
            $table->enum('status', ['DRAFT', 'ACTIVE', 'BLOCKED'])
                ->default('DRAFT');
            $table->foreignId('source_id')
                ->constrained('sources')
                ->cascadeOnDelete();
            $table->boolean('isImage')
                ->default(false);
            $table->text('description')->nullable();
            $table->string('pubDate')->nullable();
            $table->string('enclosure::url')->nullable();
            $table->timestamps();
            $table->index(['slug', 'status', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
