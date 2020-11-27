<?php

namespace App\Http\Controllers;

use App\Transformers\StudentTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Requests\StudentRequest;
use App\Repositories\StudentRepository;

/**
 * Class StudentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudentsController extends Controller
{
    /**
     * @var StudentRepository
     */
    protected $repository;

    /**
     * StudentsController constructor.
     *
     * @param StudentRepository $repository
     */
    public function __construct(StudentRepository $repository)
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
        $students = $this->repository->all();

        $response = [];

        if($students->count() > 0){
            foreach ($students as $class){
                $response[] = (new StudentTransformer())->transform($class);
            }
        }

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentRequest $request
     *
     * @return Response
     *
     */
    public function store(StudentRequest $request)
    {
        $formData = $request->all();
        $dob = $formData["date_of_birth"]["year"].'-'.$formData["date_of_birth"]["month"].'-'.$formData["date_of_birth"]["day"];
        $request->merge(['date_of_birth' => $dob]);

        $class = $this->repository->store($request);

        return response()->json((new StudentTransformer())->transform($class));
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
        $class = $this->repository->getStudentById($id);

        return response()->json((new StudentTransformer())->transform($class));
    }
}
