<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\VideoUploaderCreateRequest;
use App\Http\Requests\VideoUploaderUpdateRequest;
use App\Repositories\VideoUploaderRepository;
use FFMpeg\Filters\Video\VideoFilters;
use Illuminate\Support\Facades\Storage;

/**
 * Class VideoUploadersController.
 *
 * @package namespace App\Http\Controllers;
 */
class VideoUploadersController extends Controller
{
    /**
     * @var VideoUploaderRepository
     */
    protected $repository;

    /**
     * VideoUploadersController constructor.
     *
     * @param VideoUploaderRepository $repository
     */
    public function __construct(VideoUploaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = $this->repository->all();

        if($files->count() > 0) {
            foreach ($files as $key => $value) {
                $file_qualities = [];
                foreach (glob(storage_path('app/uploads/5fc3f0abac8f7/*.mp4')) as $filename) {
                    $file = substr($filename, strrpos($filename, '/') + 1);
                    $quality = str_replace(".mp4", "", $file);
                    array_push($file_qualities,$quality);
                }
                $files[$key]->file_qualities = $file_qualities;
            }
        }
        //dd($files);
        return view('welcome', compact('files'));
    }

    public function fileUpload(Request $request){
        $request->validate([
            'file' => 'required|mimes:mp4'
        ]);

        if($request->file()) {
            $uploadedFile = $request->file('file');
            $filename = time().$uploadedFile->getClientOriginalName();

            \Storage::disk('public')->putFileAs(
                $filename,
                $uploadedFile,
                $filename
            );


            $file_path = uniqid();

            $this->generate_video_qualities($filename, $file_path);

            $this->repository->create([
                'name'      => $filename,
                'file_path' => $file_path
            ]);

            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $filename);
        }
    }

    public function generate_video_qualities($file_name,$file_path){
        $videoQualities = [
            [256,144],
            [426,240],
            //[640,360],
            //[854,480]
/*            [1280,720],
            [1920,1080],
            [2560,1440],
            [3840,2160]*/
        ];
        $path = 'public/uploads/'.$file_path;

        \File::isDirectory($path) or \File::makeDirectory($path, 0777, true, true);
        foreach ($videoQualities as $videoQuality) {
            \FFMpeg::open('public/'.$file_name.'/'.$file_name)
                ->addFilter(function (VideoFilters $filters) use($videoQuality) {
                    $filters->resize(new \FFMpeg\Coordinate\Dimension($videoQuality[0], $videoQuality[1]));
                })
                ->export()
                ->inFormat(new \FFMpeg\Format\Video\WebM())
                ->save($path.'/'.$videoQuality[1].'.mp4');
        }
    }

    public function getVideoById($id){
        $file = $this->repository->findWhere(['id' => $id])->first();
        if($file->count() > 0) {
            $file_qualities = [];
            foreach (glob(storage_path('app/public/uploads/'.$file->file_path.'/*.mp4')) as $key => $filename) {
                $filename = substr($filename, strrpos($filename, '/') + 1);
                $quality = str_replace(".mp4", "", $filename);
                if($key == 0){
                    $file_qualities[] = [
                        "default"   => true,
                        "name"      => $quality,
                        "url"       => \Storage::disk('public')->url('uploads/'.$file->file_path.'/'.$filename)
                    ];
                }else{
                    $file_qualities[] = [
                        "name"      => $quality,
                        "url"       => \Storage::disk('public')->url('uploads/'.$file->file_path.'/'.$filename)
                    ];
                }
            }
            $file->file_qualities = $file_qualities;
        }

        return view('play_video', compact('file'));
    }
}
