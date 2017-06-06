<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Employee",
 *      required={"boss_id", "boss_work_id", "boss_name", "work_id", "name", "english_name", "job", "job_point", "phone", "email", "address", "entered_at", "professional_qualification", "account"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="boss_id",
 *          description="boss_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="boss_work_id",
 *          description="boss_work_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="boss_name",
 *          description="boss_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="work_id",
 *          description="work_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="english_name",
 *          description="english_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="job",
 *          description="job",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="job_point",
 *          description="job_point",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="entered_at",
 *          description="entered_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="professional_qualification",
 *          description="professional_qualification",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="account",
 *          description="account",
 *          type="string"
 *      )
 * )
 */
class Employee extends Model
{
    use SoftDeletes;

    public $table = 'employees';

    protected $dates = ['deleted_at'];

    const STATUS_OF_OFF = 'off';
    const STATUS_OF_ON = 'on';


    public $fillable = [
        'user_id',
        'rank_id',
        'boss_id',
        'work_id',
        'name',
        'phone',
        'email',
        'performance',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'rank_id' => 'integer',
        'boss_id' => 'integer',
        'boss_work_id' => 'string',
        'boss_name' => 'string',
        'work_id' => 'string',
        'name' => 'string',
        'english_name' => 'string',
        'job_point' => 'float',
        'phone' => 'string',
        'email' => 'string',
        'address' => 'string',
        'entered_at' => 'date',
        'professional_qualification' => 'float',
        'account' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'english_name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'address' => 'required',
        'entered_at' => 'required',
        'professional_qualification' => 'required',
        'account' => 'required',
        'has_basic_salary' => 'required',
        'original_performance' => 'required',
    ];
    
    /**** relationship ****/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function policies()
    {
        return $this->morphMany(Policy::class,'policieable');
    }

    public function performances()
    {
        return $this->morphMany(Performance::class,'performanceable');
    }


    public function boss()
    {
        return $this->belongsTo(Employee::class);
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class,'boss_id');
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    /**** functions ****/
    public function isOn()
    {
        return $this->status == Employee::STATUS_OF_ON;
    }

    public function getAllSubordinates(&$data = [])
    {
        $subordinates = $this->subordinates;

        if (count($subordinates) == 0){
            return $data;
        }

        foreach ($subordinates as $key => $subordinate){
            $subordinate->getAllSubordinates($data);
            array_push($data,$subordinate);

        }

        return $data;
    }

    public function isEmployee()
    {
        return true;
    }



    public function upgradeOrRelease($data)
    {
        if (!$this->upgrade($data)){
            //不能晋升
            $this->release($data);//直接发放业绩
        }

    }

    protected function upgrade($data)
    {
        $rank = $this->rank;
        if ($rank->isTop() || !$rank->sameType($data['type'])){
            //职级以经到顶或者发放的业绩类型和升级条件类型不符合
            return false;
        }
        if ($rank->type == Employee::TYPE_OF_PERSONAL){
            //个人业绩
            $remain = $data['release_amount'] + $this->personal_performance - $rank->performance_required;//计算多出的业绩用于拆单

            $this->separate($remain,$data);
        }
        if ($rank->type == Employee::TYPE_OF_TEAM){
            //团队业绩
            if ($rank->job_point == 2.3){
                $first_subordinate_performance = 0;

                foreach ($this->subordinates as $subordinate){
                    $first_subordinate_performance += $subordinate->team_performance;//计算直属一级团队业绩

                    $remain = $first_subordinate_performance - $rank->performance_required;

                    $this->separate($remain,$data);
                }
            }elseif ($rank->job_point == 2.6 || $rank->job_point == 2.9){
                if($this->canCondition($rank)){
                    $this->separate(0,$data);
                }
            }
        }

    }

    public function release($data)
    {
        if ($data['type'] == 'personal'){
            $this->personal_performance += $data['release_amount'];//累加个人业绩
        }elseif ($data['type'] == 'team'){
            $this->team_performance += $data['release_amount'];//累加团队业绩
        }else{
            dd('未知的业绩类型');
        }
        $this->total_performance += $data['release_amount'];//累加总业绩
        $this->save();
        $this->performances()->create($data);//新增业绩记录
    }

    public function separate($remain,$data)
    {
        if ($remain < 0){
            return false;
        }elseif($remain == 0){
            $this->rank_id--;
            $this->save();
            $this->release($data);
        }else{
            $this->rank_id--;
            $this->save();
            $data['release_amount'] -= $remain;
            $this->release($data);
            $data['release_amount'] = $remain;
            $this->release($data);
        }
    }

    protected function canCondition($rank)
    {
        $first_subordinate_performance = 0;
        $second_subordinate_performance = 0;
        $count1 = 0;
        $count2 = 0;

        foreach ($this->subordinates as $subordinate){
            $first_subordinate_performance += $subordinate->team_performance;//计算直属一级团队业绩
            foreach ($subordinate->subordinates as $second_subordinate){
                $second_subordinate_performance += $second_subordinate->team_performance;//计算直属二级团队业绩
            }
        }
        $can = $rank->performance_required <= $first_subordinate_performance + ($second_subordinate_performance * 0.3);
        if ($can){
            return true;
        }
        if ($rank->job_point == 2.6){
            foreach ($this->getAllSubordinates() as $subordinate){
                if ($subordinate->job_point == 2.0){
                    $count1++;
                }elseif ($subordinate->job_point == 2.3){
                    $count2++;
                }
            }
        }elseif ($rank->job_point == 2.9){
            foreach ($this->getAllSubordinates() as $subordinate){
                if ($subordinate->job_point == 2.3){
                    $count1++;
                }elseif ($subordinate->job_point == 2.6){
                    $count2++;
                }
            }
        }
        return $count1 >= 2 && $count2 >= 2;
    }

    //获取与上级的职级差
    public function getJobPointDiff(&$level)
    {
        $boss = $this->boss;//获取上级
        $result = $boss->job_point - $this->job_point;//计算职级差
        if($result < 0){
            return 0;
        }
        if($result == 0){
            //同级
            if($this->job_point != 3.2){
                //不是3.2职级
                return 0;
            }
            if($level == 1){
                //第一级同级
                $result = 0.1;
            }elseif ($level >= 2){
                //第二级同级
                $result = 0.05;
            }
            $level++;
        }
        return $result/100;
    }

    public function teamPerformanceSum()
    {
        $result = 0;
        foreach ($this->getAllSubordinates() as $subordinate){
            $result += $subordinate->team_performance;
        }
        return $result;
    }

    /**** attribute ****/
    public function getHasBasicSalaryValueAttribute()
    {
        if($this->has_basic_salary){
            return '有';
        }
        return '无';
    }

    public function getBossNameAttribute()
    {
        return isset($this->boss) ? $this->boss->name : '';
    }

    public function getBossWorkIdAttribute()
    {
        return isset($this->boss) ? $this->boss->work_id : '';
    }

    public function getJobPointAttribute()
    {
        return isset($this->rank) ? $this->rank->job_point : 0;
    }

    public function getNextJobPointAttribute()
    {
        if ($this->rank->isTop()){
            return '无';
        }
        return Rank::findOrFail($this->rank->id+1)->job_point;
    }

    public function getNeedToUpgradeAttribute()
    {
        $rank = $this->rank;
        if($rank->isTop()){
            return 0;
        }
        if($rank->type == Employee::TYPE_OF_PERSONAL){
            return $rank->performance_required - $this->personal_performance;
        }
        return $rank->performance_required - $this->team_performance;
    }

}
