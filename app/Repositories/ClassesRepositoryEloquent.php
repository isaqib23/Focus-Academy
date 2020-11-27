<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClassesRepository;
use App\Entities\Classes;
use App\Validators\ClassesValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ClassesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ClassesRepositoryEloquent extends BaseRepository implements ClassesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Classes::class;
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
     */
    public function store($request){
        return $this->updateOrCreate(
            [
                'id'          => $request->input('id')
            ],
            [
                'name'          => $request->input('name'),
                'code'          => $request->input('code'),
                'max_students'  => $request->input('max_students'),
                'status'        => ($request->has('status')) ? $request->input('status') : 'opened',
                'description'   => $request->input('description'),
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getClassById($id) {
        return $this->find($id);
    }
}
