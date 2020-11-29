<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VideoUploaderRepository;
use App\Entities\VideoUploader;
use App\Validators\VideoUploaderValidator;

/**
 * Class VideoUploaderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VideoUploaderRepositoryEloquent extends BaseRepository implements VideoUploaderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VideoUploader::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
