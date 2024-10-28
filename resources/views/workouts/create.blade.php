<h1>Add New Workout</h1>
<form action="{{ route('workouts.store') }}" method="POST">
    @csrf
    <label>Exercise:</label>
    <input type="text" name="exercise" required><br>
    <label>Sets:</label>
    <input type="number" name="sets" min="1" required><br>
    <label>Reps:</label>
    <input type="number" name="reps" min="1" required><br>
    <label>Weight:</label>
    <input type="number" name="weight" step="0.1"><br>
    <label>Category:</label>
    <select name="category">
        <option value="strength">Strength</option>
        <option value="cardio">Cardio</option>
    </select><br>
    <button type="submit">Add Workout</button>
</form>
