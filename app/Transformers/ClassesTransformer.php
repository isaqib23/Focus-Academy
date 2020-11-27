<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Classes;

/**
 * Class ClassesTransformer.
 *
 * @package namespace App\Transformers;
 */
class ClassesTransformer extends TransformerAbstract
{
    /**
     * Transform the Classes entity.
     *
     * @param Classes $model
     *
     * @return array
     */
    public function transform(Classes $model)
    {
        $return = [
            'id'            => (int) $model->id,
            'code'          => (string) $model->code,
            'name'          => (string) $model->name,
            'max_students'  => (string) $model->max_students,
            'status'        => (string) $model->status,
            'description'   => (string) $model->description,
        ];

        // Class students
        $return = $this->getStudents($model, $return);

        return $return;
    }

    /**
     * @param $model
     * @param array $return
     * @return array
     */
    public function getStudents($model, array $return)
    {
        if ($model->students->count() > 0) {
            $students = [];
            foreach ($model->students as $key => $value) {
                $students[] = (new StudentTransformer())->transform($value);
            }
            $return['students'] = $students;
        }else{
            $return['students'] = $model->students;
        }

        return $return;
    }
}
