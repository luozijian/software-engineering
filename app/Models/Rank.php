<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Rank",
 *      required={"name", "job_point", "personal_performance_required", "team_performance_required", "total_performance"},
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
 *          property="job_point",
 *          description="job_point",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="personal_performance_required",
 *          description="personal_performance_required",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="team_performance_required",
 *          description="team_performance_required",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="total_performance",
 *          description="total_performance",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Rank extends Model
{
    use SoftDeletes;

    public $table = 'ranks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'job_point',
        'personal_performance_required',
        'team_performance_required',
        'total_performance'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'job_point' => 'float',
        'personal_performance_required' => 'integer',
        'team_performance_required' => 'integer',
        'total_performance' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'job_point' => 'required',
        'personal_performance_required' => 'required',
        'team_performance_required' => 'required',
    ];

    /**** relationship ****/
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    /**** function ****/
    public function isTop()
    {
        return $this->name == '合伙人';
    }

    public function isPersonal()
    {
        return $this->type == 'personal';
    }

    public function sameType($type)
    {
        return $this->type == $type;
    }

    /**** getAttribute ****/
    public function getCondition1Attribute($value)
    {
        return json_decode($value,true);
    }

    public function getCondition2Attribute($value)
    {
        return json_decode($value,true);
    }

    public function getPerformanceRequiredDisplayAttribute()
    {
        if($this->isTop()){
            return '无法升级';
        }elseif($this->isPersonal()){
            return $this->performance_required.'(个人)';
        }else{
            return $this->performance_required.'(团队)';
        }
    }

    public function getCondition1DisplayAttribute()
    {
        $result = '';
        $condition1 = $this->condition1;
        if($condition1){
            foreach ($condition1 as $item){
                if($item['description'] == 'directly'){
                    $result .= '直属业绩'.$item['rate'].'%';
                }else{
                    $result .= '+直属二级业绩'.$item['rate'].'%';
                }
            }
        }else{
            $result = '无';
        }
        return $result;
    }

    public function getCondition2DisplayAttribute()
    {
        $result = '';
        $condition2 = $this->condition2;
        if($condition2){
            foreach ($condition2 as $item){
                if($item['description'] == 'job_point'){
                    $result .= $item['count'].'个'.$item['rank'].' ';
                }else{
                    $result .= $item['rate'].'%'.' ';
                }
            }
        }else{
            $result = '无';
        }
        return $result;
    }

    public function getTypeNameAttribute()
    {
        return $this->type == Employee::TYPE_OF_PERSONAL ? '个人' : '团队';
    }
}
