<html>
<head>
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<table class="table table-striped">
    <col style="width:5%">
    <col style="width:55%">
    <col style="width:40%">
    <thead >
    <tr>
        <th class="px-4 py-2">Title</th>
        <th class="px-4 py-2">Description</th>
        <th class="px-4 py-2">Time</th>
    </tr>
    </thead>
    <tbody >

    @foreach($all_items as $dat)

    <tr>
        <td>{{  $dat->name }}</td>
        <td>{{ $dat->description }}</td>
        <td > {{ $dat->started_at}}  <br>
            {{ $dat->ended_at}}</td>

    </tr>
        @endforeach
</table>



</body>
</html>
