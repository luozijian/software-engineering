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
        'type' => 'string',
        'supplier' => 'string',
        'plan' => 'string',
        'year' => 'integer',
        'year_period_count' => 'integer',
        'year_period' => 'string',
        'begin_at' => 'date'
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
    public function channelProducts()
    {
        return $this->hasMany(ChannelProduct::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    public function performances()
    {
        return $this->hasMany(Performance::class);
    }

    /**** function ****/
    public function isTypeA()
    {
        return $this->type == 'A';
    }

    public function isOpen()
    {
        return $this->status == 'on';
    }

    //获取产品今年BV系数
    public function getBVPointForNow($signer,$policy)
    {
        if($signer->isEmployee()){
            $BV_point = $this->getRate($this->year_period,$policy);
        }else{
            $year_period = $this->channelProducts()->where('channel_id',$signer->id)->first()->year_period_array;
            $BV_point = $this->getRate($year_period,$policy);
        }
        return $BV_point;
    }

    //获取产品系数总和
    public function getBVPointSum($signer)
    {
        if($signer->isEmployee()){
            $BV_point = $this->getSum($this->year_period);
        }else{
            $year_period = $this->channelProducts()->where('channel_id',$signer->id)->first()->year_period_array;
            $BV_point = $this->getSum($year_period);
        }
        return $BV_point ? $BV_point : 0;
    }

    protected function getRate($year_period,$policy)
    {
        foreach ($year_period as $item){
            $start = $policy->created_at->addYears($item['start']-1);
            $end = $policy->created_at->addYears($item['end']-1);
            if($start->isPast() && $end->isFuture()){
                return $item['rate'];
            }
        }
        return null;
    }

    protected function getSum($year_period)
    {
        $sum = 0;
        foreach ($year_period as $item){
            $sum += $item['rate'];
        }
        return $sum;
    }

    /**** getAttribute ****/
    public function getYearPeriodAttribute($value)
    {
        if(!$value){
            return [];
        }
        return json_decode($value,true);
    }

    public function getYearPeriodJsonAttribute()
    {
        return json_encode($this->year_period);
    }

    /**** setAttribute ****/
    public function setYearPeriodAttribute($value)
    {
        $this->attributes['year_period'] = json_encode($value);
    }
}
