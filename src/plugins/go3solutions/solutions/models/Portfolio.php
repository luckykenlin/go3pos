<?php namespace Go3solutions\Solutions\Models;

use Model;

/**
 * Model
 */
class Portfolio extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'go3solutions_solutions_portfolio';


    public $attachMany = [
        'photos' => ['System\Models\File', 'public' => true]
    ];

    public $rules = [
        'photos'   => 'required',
        'photos.*' => 'image'
    ];
}
