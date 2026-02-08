<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $exercise->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <a href="{{ route('exercises.index') }}" class="btn btn-secondary mb-3">← Назад</a>
        
        <div class="card">
            <div class="card-header">
                <h2>{{ $exercise->name }}</h2>
                <span class="badge bg-{{ 
                    $exercise->difficulty == 'beginner' ? 'success' : 
                    ($exercise->difficulty == 'intermediate' ? 'warning' : 'danger') 
                }}">
                    {{ $exercise->difficulty == 'beginner' ? 'Начинающий' : 
                       ($exercise->difficulty == 'intermediate' ? 'Средний' : 'Продвинутый') }}
                </span>
            </div>
            
            <div class="card-body">
                <h5>Группа мышц: {{ $exercise->muscle_group }}</h5>
                
                <div class="mb-3">
                    @if($exercise->reps)
                        <span class="badge bg-primary me-2">Повторения: {{ $exercise->reps }}</span>
                    @endif
                    @if($exercise->duration_seconds)
                        <span class="badge bg-info">Время: {{ $exercise->duration_seconds }} секунд</span>
                    @endif
                </div>
                
                <h4>Описание:</h4>
                <p>{{ $exercise->description }}</p>
                
                <h4>Инструкция по выполнению:</h4>
                <div class="bg-light p-3 rounded">
                    {!! nl2br(e($exercise->instructions)) !!}
                </div>
                
                @if($exercise->images)
                    <h4 class="mt-4">Изображения:</h4>
                    <div class="row">
                        @foreach($exercise->images as $image)
                            <div class="col-md-6">
                                <img src="{{ asset('storage/images/' . $image) }}" 
                                     alt="{{ $exercise->name }}" 
                                     class="img-fluid rounded mb-2"
                                     style="max-height: 300px;">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <div class="card-footer text-muted">
                Добавлено: {{ $exercise->created_at->format('d.m.Y H:i') }}
            </div>
        </div>
    </div>
</body>
</html>