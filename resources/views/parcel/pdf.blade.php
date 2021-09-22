<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $parcel->getPost->town }}</title>
    <style>
        @font-face {
            font-family: 'Open Sans';
            src: url({{ asset('fonts/OpenSans-Regular.TTF') }});
            font-weight: bold;
        }
        body {
            font-family: 'Open Sans';
        }
        div {
            margin: 7px;
            padding: 7px;
        }
        .master {
            font-size: 18px;
        }
        .about {
            font-size: 14px;
            color: gray;
        }
        .color {
            margin: 12px;
            font-size: 25px;
            text-transform: uppercase;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>{{ $parcel->weight }}</h1>
    <div class="size">Size: {{ $parcel->phone }} km<sup>2</sup></div>
    <div class="about">{!! $parcel->info !!}</div>
    <h3>Posts:</h3>
    @foreach ($posts as $post)
        @if ($post->post_id == $post->id)
            <div class="master">
                {{ $post->town }} {{ $post->code }}
            </div>
        @endif

    @endforeach
</body>

</html>