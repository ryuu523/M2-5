<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{route("menu")}}" method="get">
        <input type="submit" value="menuに戻る">
    </form>
    
    <form action="{{route("dispatche.create")}}" method="get">
        <input type="submit" value="派遣情報新規作成">
    </form>
    
    <table>
        <thead>
            <tr>
                <th>イベント名</th>
                <th>人材氏名</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dispatches as $dispatche)
                <tr>
                    <td>{{$dispatche->event->title}}</td>
                    <td>{{$dispatche->worker->name}}</td>
                    <td>
                        <form action="{{route("dispatche.edit", $dispatche->id)}}" method="get">
                            <input type="submit" value="編集">
                        </form>
                    </td>
                    <td>
                        <form action="{{route("dispatche.destroy", $dispatche->id)}}" method="post">
                            @csrf
                            @method("DELETE")
                            <input type="submit" onclick="return confirm('削除してもよろしいですか？')" value="削除">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (session("message"))
        <p>{{session("message")}}</p>
    @endif
</body>

</html>