<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentRepository;
use App\Entities\Student;
use App\Validators\StudentValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class StudentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudentRepositoryEloquent extends BaseRepository implements StudentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Student::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $request
     * @return mixed
     * @throws ValidatorException
     *
     */
    public function store($request){
        return $this->updateOrCreate(
            [
                'id'          => $request->input('id')
            ],
            [
                'first_name'         => $request->input('first_name'),
                'last_name'          => $request->input('last_name'),
                'class_id'           => $request->input('class_id'),
                'date_of_birth'      => $request->input('date_of_birth'),
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getStudentById($id) {
        return $this->find($id);
    }
}
