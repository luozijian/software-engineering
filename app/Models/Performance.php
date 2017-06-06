<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Performance",
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_id",
 *          description="product_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="repay_amount",
 *          description="repay_amount",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="repay_year",
 *          description="repay_year",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="repay_amount_year",
 *          description="repay_amount_year",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="job_point_diff",
 *          description="job_point_diff",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="deal_amount",
 *          description="deal_amount",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="product_rate",
 *          description="product_rate",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="BV_point_sum",
 *          description="BV_point_sum",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Performance extends Model
{
    use SoftDeletes;

    public $table = 'performances';
    

    protected $dates = ['deleted_at'];

    const TYPE_OF_PERSONAL = 'personal';
    const TYPE_OF_TEAM = 'team';


    public $fillable = [
        'product_id',
        'policy_id',
        'performanceable_id',
        'performanceable_type',
        'type',
        'repay_amount',
        'repay_year',
        'repay_amount_year',
        'job_point',
        'job_point_diff',
        'deal_amount',
        'product_rate',
        'BV_point_sum',
        'release_amount',
        'commission',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'type' => 'string',
        'repay_amount' => 'float',
        'repay_year' => 'integer',
        'repay_amount_year' => 'float',
        'job_point_diff' => 'float',
        'deal_amount' => 'float',
        'product_rate' => 'float',
        'BV_point_sum' => 'float',
        'release_amount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'repay_amount' => 'required',
        'repay_year' => 'required',
        'repay_amount_year' => 'required',
        'job_point_diff' => 'required',
        'deal_amount' => 'required',
        'product_rate' => 'required',
        'BV_point_sum' => 'required',
        'release_amount' => 'required',
    ];

    /**** relationship ****/
    public function performanceable()
    {
        return $this->morphTo();
    }

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**** getNameAttribute ****/
    public function getTypeNameAttribute()
    {
        if($this->type == Performance::TYPE_OF_PERSONAL){
            return '个人业绩';
        }
        return '团队业绩';
    }

    /**** functions ****/
    public function isPersonal()
    {
        return $this->type == Performance::TYPE_OF_PERSONAL;
    }
}
