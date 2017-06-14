<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Policy",
 *      required={"number", "client_name", "client_gender", "client_phone", "client_email", "company", "product", "repay_year", "repay_amount", "handle_company", "handle_signer", "begin_at", "paid_at"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="number",
 *          description="number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="client_name",
 *          description="client_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="client_gender",
 *          description="client_gender",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="client_phone",
 *          description="client_phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="client_email",
 *          description="client_email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="company",
 *          description="company",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="product",
 *          description="product",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="repay_year",
 *          description="repay_year",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="repay_amount",
 *          description="repay_amount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="handle_company",
 *          description="handle_company",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="handle_signer",
 *          description="handle_signer",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="begin_at",
 *          description="begin_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="paid_at",
 *          description="paid_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Policy extends Model
{
    use SoftDeletes;

    public $table = 'policies';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'policy_number',
        'product_id',
        'employee_id',
        'client_name',
        'client_gender',
        'client_phone',
        'client_email',
        'deal_amount',
        'job_point',
        'performance',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'policy_number' => 'string',
        'work_id' => 'string',
        'commission_rule' => 'integer',
        'client_name' => 'string',
        'client_gender' => 'string',
        'client_phone' => 'string',
        'client_email' => 'string',
        'repay_year' => 'integer',
        'repay_amount' => 'integer',
        'handle_company' => 'string',
        'handle_signer' => 'string',
        'job_point' => 'float',
        'begin_at' => 'date',
        'paid_at' => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'client_name' => 'required',
        'client_gender' => 'required',
        'client_phone' => 'required',
        'client_email' => 'required|email',
        'deal_amount' => 'required',
    ];

    /**** relationship ****/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function performances()
    {
        return $this->hasMany(Performance::class);
    }

    /**** getNameAttribute ****/
    public function getGenderAttribute()
    {
        return $this->client_gender ? '男' : '女';
    }

}
