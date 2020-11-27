<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Student;

/**
 * Class StudentTransformer.
 *
 * @package namespace App\Transformers;
 */
class StudentTransformer extends TransformerAbstract
{
    /**
     * Transform the Student entity.
     *
     * @param \App\Entities\Student $model
     *
     * @return array
     */
    public function transform(Student $model)
    {
        $return = [
            'id'                => (int) $model->id,
            'first_name'        => (string) $model->first_name,
            'last_name'         => (string) $model->last_name,
            'date_of_birth'     => (string) $model->date_of_birth,
            'class_id'          => (string) $model->class_id,
            'student_class'     => (string) $model->student_class->name
        ];

        // date format for picker
        $return = $this->formatted_dob($model, $return);

        return $return;
    }

    public function formatted_dob($model, array $return)
    {
        $year = date("Y", strtotime($model->date_of_birth));
        $month = date("m", strtotime($model->date_of_birth));
        $day = date("d", strtotime($model->date_of_birth));
        $return['formatted_dob'] = (object)['year' => (int)$year, 'month' => (int)$month, 'day' => (int)$day];

        return $return;
    }
}
