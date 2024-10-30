<!DOCTYPE html>
<html>
<head>
    <title>Workouts</title>
</head>
<body>
    <h1>Workouts</h1>
    <a href="{{ route('workouts.create') }}">Add New Workout</a>
    <ul>
        @foreach($workouts as $workout)
            <li>
                {{ $workout->exercise }} - {{ $workout->category }}
                <a href=" {{ route('workouts.show', $workout)}} ">View</a>
                <a href="{{ route('workouts.edit', $workout) }}">Edit</a>
                <form action="{{ route('workouts.destroy', $workout) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
