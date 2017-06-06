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
        'policieable_id',
        'policieable_type',
        'work_id',
        'commission_rule',
        'client_name',
        'client_gender',
        'client_phone',
        'client_email',
        'repay_year',
        'repay_amount',
        'repay_amount_year',
        'handle_company',
        'job_point',
        'begin_at',
        'paid_at',
        'is_renewal',
        'renewal_count',
        'commission_release_count',
        'review_count',
        'transfer_count',
        'currency',
        'commission',
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
        'repay_year' => 'required',
        'repay_amount' => 'required',
        'handle_company' => 'required',
        'begin_at' => 'required',
        'paid_at' => 'required'
    ];

    /**** functions ****/
    public function isRenewal()
    {
        return $this->paid_at->isFuture() && $this->is_renewal;
    }

    public function hasReleased()
    {
        $message = '';
        if($this->commission_release_count == 0){
            return $message;
        }

        $should_release_at = $this->created_at->addMonths($this->commission_rule * $this->commission_release_count);

        if($should_release_at->isFuture()) {
            $message = '您在'.$this->commission_rule.'个月内已经发放过佣金,请在'.$should_release_at->addMonths($this->commission_rule)->toDateString().'之后发放佣金';
        }
        return $message;
    }

    public function lastReleasedAt()
    {
        $last_release_record = $this->commissionReleaseRecords()->latest()->first();
        if($last_release_record){
            return $last_release_record->created_at;
        }
        return null;
    }

    public function shouldNotify()
    {
        return $this->paid_at->subDays(option('advance'))->isToday();
    }

    public function isFinished()
    {
        if (count($this->commissionReleaseRecords) > 0){
            return $this->commissionReleaseRecords()->sum('release_amount') == $this->commission;
        }
        return false;
    }

    /**** relationship ****/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function commissionReleaseRecords()
    {
        return $this->hasMany(CommissionReleaseRecord::class);
    }

    public function policieable()
    {
        return $this->morphTo();
    }

    public function performances()
    {
        return $this->hasMany(Performance::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    /**** getAttribute ****/
    public function getGenderAttribute()
    {
        return $this->client_gender ? '男' : '女';
    }

    public function getCurrencyNameAttribute()
    {
        return $this->currency ? '港币' : '美金';
    }
}
