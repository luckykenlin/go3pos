<?php namespace Go3solutions\Solutions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGo3solutionsSolutionsPortfolio extends Migration
{
    public function up()
    {
        Schema::create('go3solutions_solutions_portfolio', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('go3solutions_solutions_portfolio');
    }
}
