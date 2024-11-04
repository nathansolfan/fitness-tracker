<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Fitness Tracker')</title>
    @livewireStyles <!-- This will include Livewire styles if using Livewire -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        header {
            margin-bottom: 20px;
        }
        .content {
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1>@yield('header', 'Fitness Tracker')</h1>
        <nav>
            <a href="{{ route('workouts.index') }}">Home</a> |
            <a href="{{ route('workouts.create') }}">Add New Workout</a>
        </nav>
        <hr>
    </header>

    <div class="content">
        @yield('content')
    </div>

    @livewireScripts <!-- This will include Livewire scripts if using Livewire -->
</body>
</html>
