<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route("event.index")}}" method="get">  
        <input type="submit" value="戻る">
    </form>
    <form action="{{route("event.update",$event->id)}}" method="post">
        @method("PUT")
        @csrf
        title: <input type="text" name="title" value="{{$event->title}}">
        place: <input type="text" name="place"  value="{{$event->place}}">
        date: <input type="date" name="date" value="{{$event->date}}">
        <input type="submit" value="登録">
    </form>
    @if (session("errors"))
        <p>エラーが発生しました</p>
    @endif
</body>
</html>