<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="{{$slug->meta_description}}">
    @if ($slug->index)
        <meta name="robots" content="index, follow">
    @else
        <meta name="robots" content="noindex, nofollow">
    @endif

    <meta property="og:title" content="{{$slug->meta_title}}">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="da_DK">
    <link href="{{ mix('/css/home/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/home/app.js') }}" defer></script>
    <title>{{$event->title}}</title>
</head>
<body>
@yield('content')

</body>
</html>
