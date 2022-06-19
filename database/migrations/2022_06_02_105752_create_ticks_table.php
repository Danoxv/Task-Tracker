<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 128);
            $table->string('text', 8000)->nullable();
            $table->enum('status', ['open', 'closed']);
            $table->foreignId('author_id')->constrained('users');
            $table->foreignUuid('checklist_id')->constrained('checklists')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticks');
    }
}
