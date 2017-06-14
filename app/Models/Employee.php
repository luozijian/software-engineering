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
        'phone' => 'required',
        'email' => 'required',
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
        return $this->hasMany(Performance::class);
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

    /**** attribute ****/
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
}
