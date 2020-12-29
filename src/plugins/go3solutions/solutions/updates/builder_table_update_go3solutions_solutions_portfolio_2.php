<?php namespace Go3solutions\Solutions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGo3solutionsSolutionsPortfolio2 extends Migration
{
    public function up()
    {
        Schema::table('go3solutions_solutions_portfolio', function($table)
        {
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::table('go3solutions_solutions_portfolio', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
