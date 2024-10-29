<h1>Workout Details:</h1>
<p>Exercise: {{$workout->exercise}} </p>
<p>Sets: {{$workout->sets}}  </p>
<p>Reps: {{$workout->sets}}  </p>
<p>Weight: {{$workout->weight}}  </p>
<p>Category: {{$workout->category}}  </p>
<a href=" {{route('workouts.index')}} ">Back to Workouts</a>
