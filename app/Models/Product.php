<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Product",
 *      required={"name", "supplier", "plan", "year", "year_period_count", "year_period"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="supplier",
 *          description="supplier",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="plan",
 *          description="plan",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="year",
 *          description="year",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="year_period_count",
 *          description="year_period_count",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="year_period",
 *          description="year_period",
 *          type="string"
 *      )
 * )
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'price',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'price' => 'required',
    ];

    /**** relationship ****/
    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    public function performances()
    {
        return $this->hasMany(Performance::class);
    }

    /**** function ****/
    public function isOpen()
    {
        return $this->status == 'on';
    }

}
