<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.3/plyr.css" />
    <title>Hello, world!</title>
</head>
<body>
<div class="container mt-2">
    <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="input-group">
            <div class="custom-file">
                <input name="file"  type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
            </div>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Upload</button>
            </div>
        </div>
    </form>

    <div class="row mt-5">
        @foreach($files as $file)
            <div class="col-4">
                <a href="{{url('play_video').'/'.$file->id}}" target="_blank" class="card" style="width: 18rem;">
                    <img src="https://cdn.shopify.com/s/files/1/2018/8867/files/play-button.png" class="card-img-top">
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-5">
        {{--<video id="player" playsinline controls>
            <source src="{{url('converted/mall_steve.mp4')}}" type="video/mp4" />
        </video>--}}
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdn.plyr.io/3.6.3/plyr.polyfilled.js"></script>
<script>
    /*const player = new Plyr('#player', {
        controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'],
        settings: ['captions', 'quality', 'speed', 'loop'],
    });*/
</script>

</body>
</html>
