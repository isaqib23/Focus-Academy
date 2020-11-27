<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Classes.
 *
 * @package namespace App\Entities;
 */
class Classes extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'max_students'
    ];

    public function students(){
        return $this->hasMany(Student::class,'class_id','id');
    }
}
