<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained('trainers')->onDelete('cascade');
            $table->foreignId('data_price_id')->constrained('data_prices')->onDelete('cascade');
            $table->text('description');
            $table->string('image')->nullable();
            $table->foreignId('schedule_id')->constrained('schedule_trainings')->onDelete('cascade');
            $table->foreignId('categories_post_id')->constrained('categories_posts')->onDelete('cascade');
            $table->timestamp('post_date')->useCurrent();
            $table->enum('status', ['active', 'inactive']);
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
        Schema::dropIfExists('posts');
    }
}
