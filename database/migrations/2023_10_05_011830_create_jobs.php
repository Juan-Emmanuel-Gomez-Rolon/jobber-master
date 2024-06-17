<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('jobs', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string("title")->default("Job Title");
      $table->string("description")->default("Job Description");
      $table->string("category")->default("Job Category");
      $table->integer("company_id")->default(0);
      $table->string("company_name")->default("Company Name");
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('jobs');
  }
};
