<ul>
    @foreach($workouts->groupBy('exercise') as $exercise => $workoutGroup)
        <li>
            <strong>{{ $exercise }}</strong> - {{ $workoutGroup->first()->category }}
            <br>
            {{--  ->count() displa how many times tat exercise has been logged       --}}
            Total Sessions: {{ $workoutGroup->count() }}
            <br>
            {{-- 0>last()->weight --}}
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
