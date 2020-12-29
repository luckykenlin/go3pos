<?php namespace Go3solutions\Career\Models;

use Model;

/**
 * Model
 */
class CareerJob extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'go3solutions_career_job';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
