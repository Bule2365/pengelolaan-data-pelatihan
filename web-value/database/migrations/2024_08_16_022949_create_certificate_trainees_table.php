<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_trainees', function (Blueprint $table) {
            $table->id();
            $table->date('issue_date');
            $table->foreignId('trainee_id')->constrained('trainees')->onDelete('cascade');
            $table->string('certificate_image');
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
        Schema::dropIfExists('certificate_trainees');
    }
}
