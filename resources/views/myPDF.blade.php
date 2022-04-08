<html>
<head>
</head>
<body>
<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>description</th>
        <th>time</th>
    </tr>
    @foreach($all_items as $dat)

    <tr>
        <td>{{ $dat->id }}</td>
        <td>{{  $dat->name }}</td>
        <td>{{ $dat->description }}</td>
        <td >From {{ $dat->started_at}} to {{ $dat->ended_at}}</td>

    </tr>
        @endforeach
</table>



</body>
</html>
