<h1>Edit Workout</h1>
<form action=" {{route('workouts.update', $workout)}} " method="POST">
    @csrf
    @method('PUT')
    <label>Exercise:</label>
    <input type="text" name="exercise" value=" {{$workout->exercise}} " required><br>
    <label>Sets:</label>
    <input type="text" name="exercise" value="{{$workout->sets}}" min="1" required><br>
    <label>Reps:</label>
    <input type="text" name="exercise" value="{{$workout->reps}}" min="1" required><br>
    <label>Weight:</label>
    <input type="text" name="exercise" value="{{$workout->weight}}" step="0.1"><br>
    <label>Category:</label>
    <select name="categpry" >
        <option value="strength" {{$workout->category == 'strength' ? 'selected' : ''}}>Strength</option>
        <option value="cardio" {{$workout->category == 'cardio' ? 'selected' : ''}}>Cardio</option>
    </select><br>
    <button type="submit" >Update Workout</button>
</form>
<a href=" {{route('workouts.index')}}">Back to Workouts</a>
