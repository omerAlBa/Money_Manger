<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('budgets_id')->nullable();
            $table->unsignedBigInteger('categories_id')->nullable();
            $table->timestamps();

            $table->primary('budgets_id','categories_id');

            $table->foreign('budgets_id')
                ->references('id')->on('budgets')
                ->onDelete('cascade');

                $table->foreign('categories_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budgets_categories');
    }
}
