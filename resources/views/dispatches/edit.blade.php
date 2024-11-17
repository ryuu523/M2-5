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
    <form action="{{route("dispatche.update", $dispatche->id)}}" method="post">
        @method("PUT")
        @csrf
        イベント:<select name="event" id="">
            @foreach ($events as $event)

                <option value="{{$event->id}}" {{$event->id==$dispatche->event_id ? "selected" : ""}}>{{$event->title}}</option>
            @endforeach
        </select>
        人材：<select name="worker" id="">
            @foreach ($workers as $worker)
                <option value="{{$worker->id}}"  {{$worker->id==$dispatche->worker_id ? "selected" : ""}}>{{$worker->name}}</option>
            @endforeach
        </select>
        memo:<input type="text" name="memo">
        <input type="submit" value="更新">
    </form>
    @if (session("errors"))
        <p>エラーが発生しました</p>
    @endif
</body>

</html>