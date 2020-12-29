<?php namespace Go3solutions\Solutions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGo3solutionsSolutionsPortfolio extends Migration
{
    public function up()
    {
        Schema::table('go3solutions_solutions_portfolio', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('go3solutions_solutions_portfolio', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
