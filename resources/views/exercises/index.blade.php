<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фитнес Упражнения</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .exercise-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .exercise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .difficulty-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">📊 Фитнес Упражнения</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach($exercises as $exercise)
                <div class="col-md-6 col-lg-4">
                    <div class="card exercise-card">
                        <div class="card-body">
                            <span class="badge bg-{{ 
                                $exercise->difficulty == 'beginner' ? 'success' : 
                                ($exercise->difficulty == 'intermediate' ? 'warning' : 'danger') 
                            }} difficulty-badge">
                                {{ $exercise->difficulty == 'beginner' ? 'Начинающий' : 
                                   ($exercise->difficulty == 'intermediate' ? 'Средний' : 'Продвинутый') }}
                            </span>
                            
                            <h5 class="card-title">{{ $exercise->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{ $exercise->muscle_group }}
                            </h6>
                            <p class="card-text">{{ Str::limit($exercise->description, 100) }}</p>
                            
                            <div class="mb-2">
                                @if($exercise->reps)
                                    <span class="badge bg-primary">Повторения: {{ $exercise->reps }}</span>
                                @endif
                                @if($exercise->duration_seconds)
                                    <span class="badge bg-info">Время: {{ $exercise->duration_seconds }} сек</span>
                                @endif
                            </div>
                            
                            <a href="{{ route('exercises.show', $exercise) }}" class="btn btn-primary">
                                Подробнее
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <a href="{{ route('exercises.create') }}" class="btn btn-success">
                + Добавить новое упражнение
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>