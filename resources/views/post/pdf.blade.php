<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->code }}</title>
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
    <h1>{{ $post->town }}</h1>
    <div class="size">Size: {{ $post->code }} km<sup>2</sup></div>
    
    <h3>Parcels:</h3>
    @foreach ($parcels as $parcel)
        @if ($parcel->post_id == $post->id)
            <div class="master">
                {{ $parcel->weight }} {{ $parcel->phone }}
                <div class="about">{!! $parcel->info !!}</div>
            </div>
        @endif

    @endforeach
</body>

</html>