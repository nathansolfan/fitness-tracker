<!DOCTYPE html>
<html>
<head>
    <title>Workouts</title>
</head>
<body>
    <h1>Workouts</h1>

    <!-- Link to the Add New Workout page -->
    <a href="{{ route('workouts.create') }}">Add New Workout</a>

    <!-- Workout List -->
    <ul>
        @foreach($workouts->groupBy('exercise') as $exercise => $workoutGroup)
            <li>
                <strong>{{ $exercise }}</strong> - {{ $workoutGroup->first()->category }}
                <br>
                Total Sessions: {{ $workoutGroup->count() }}
                <br>
                Latest Weight: {{ $workoutGroup->last()->weight }} kg
                <br>
                <a href="{{ route('workouts.progress', ['exercise' => $exercise]) }}">View Progress</a>
                <form action="{{ route('workouts.destroy', $workoutGroup->first()) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete All Sessions</button>
                </form>
            </li>
            <hr>
        @endforeach
    </ul>
</body>
</html>
