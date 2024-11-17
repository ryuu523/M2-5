<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{route("dispatche.index")}}" method="get">
        <input type="submit" value="戻る">
    </form>
    <form action="{{route("dispatche.store")}}" method="post">
        @csrf
        イベント:<select name="event" id="">
            @foreach ($events as $event)

                <option value="{{$event->id}}">{{$event->title}}</option>
            @endforeach
        </select>
        人材：<select name="workers[]" multiple id="">
            @foreach ($workers as $worker)

                <option value="{{$worker->id}}">{{$worker->name}}</option>
            @endforeach
        </select>
        memo:<input type="text" name="memo">
        <input type="submit" value="登録">
    </form>
    @if (session("errors"))
        <p>エラーが発生しました</p>
    @endif
</body>

</html>