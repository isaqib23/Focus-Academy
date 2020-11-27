<?php

namespace App\Http\Controllers;

use App\Transformers\ClassesTransformer;
use App\Transformers\StudentTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Requests\ClassesRequest;
use App\Repositories\ClassesRepository;

/**
 * Class ClassesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ClassesController extends Controller
{
    /**
     * @var ClassesRepository
     */
    protected $repository;

    /**
     * ClassesController constructor.
     *
     * @param ClassesRepository $repository
     */
    public function __construct(ClassesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $classes = $this->repository->all();

        $response = [];

        if($classes->count() > 0){
            foreach ($classes as $class){
                $response[] = (new ClassesTransformer())->transform($class);
            }
        }

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClassesRequest $request
     *
     * @return Response
     *
     */
    public function store(ClassesRequest $request)
    {
        $class = $this->repository->store($request);

        return response()->json((new ClassesTransformer())->transform($class));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $class = $this->repository->getClassById($id);

        return response()->json((new ClassesTransformer())->transform($class));
    }
}
