<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать: {{ $exercise->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .exercise-form {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="exercise-form p-4">
                    <h1 class="text-center mb-4">✏️ Редактировать: {{ $exercise->name }}</h1>
                    
                    <a href="{{ route('exercises.index') }}" class="btn btn-outline-secondary mb-4">
                        ← Назад к списку упражнений
                    </a>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('exercises.update', $exercise) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Название упражнения *</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $exercise->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="muscle_group" class="form-label">Группа мышц</label>
                            <input type="text" class="form-control" id="muscle_group" name="muscle_group"
                                   value="{{ old('muscle_group', $exercise->muscle_group) }}"
                                   placeholder="Например: Ноги, Грудь, Пресс">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Описание *</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="3" required>{{ old('description', $exercise->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="instructions" class="form-label">Инструкция по выполнению *</label>
                            <textarea class="form-control" id="instructions" name="instructions" 
                                      rows="6" required>{{ old('instructions', $exercise->instructions) }}</textarea>
                            <div class="form-text">Введите каждый шаг с новой строки</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="difficulty" class="form-label">Уровень сложности *</label>
                                <select class="form-select" id="difficulty" name="difficulty" required>
                                    <option value="beginner" {{ old('difficulty', $exercise->difficulty) == 'beginner' ? 'selected' : '' }}>Начинающий</option>
                                    <option value="intermediate" {{ old('difficulty', $exercise->difficulty) == 'intermediate' ? 'selected' : '' }}>Средний</option>
                                    <option value="advanced" {{ old('difficulty', $exercise->difficulty) == 'advanced' ? 'selected' : '' }}>Продвинутый</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Тип упражнения</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exercise_type" 
                                               id="type_reps" value="reps" 
                                               {{ $exercise->reps ? 'checked' : '' }}>
                                        <label class="form-check-label" for="type_reps">
                                            По повторениям
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exercise_type" 
                                               id="type_time" value="time"
                                               {{ $exercise->duration_seconds ? 'checked' : '' }}>
                                        <label class="form-check-label" for="type_time">
                                            По времени
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6" id="reps-field" style="{{ $exercise->duration_seconds ? 'display: none;' : '' }}">
                                <label for="reps" class="form-label">Количество повторений</label>
                                <input type="number" class="form-control" id="reps" name="reps"
                                       value="{{ old('reps', $exercise->reps) }}"
                                       min="1">
                            </div>
                            <div class="col-md-6" id="duration-field" style="{{ $exercise->reps ? 'display: none;' : '' }}">
                                <label for="duration_seconds" class="form-label">Продолжительность (секунды)</label>
                                <input type="number" class="form-control" id="duration_seconds" name="duration_seconds"
                                       value="{{ old('duration_seconds', $exercise->duration_seconds) }}"
                                       min="1">
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('exercises.show', $exercise) }}" class="btn btn-outline-secondary me-md-2">Отмена</a>
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </div>
                    </form>
                    
                    <hr class="my-4">
                    
                    <form action="{{ route('exercises.destroy', $exercise) }}" method="POST" class="mt-3" onsubmit="return confirm('Вы уверены, что хотите удалить это упражнение?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️ Удалить упражнение</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Переключение между повторениями и временем для edit формы
        document.addEventListener('DOMContentLoaded', function() {
            const typeReps = document.getElementById('type_reps');
            const typeTime = document.getElementById('type_time');
            const repsField = document.getElementById('reps-field');
            const durationField = document.getElementById('duration-field');
            
            function toggleFields() {
                if (typeReps.checked) {
                    repsField.style.display = 'block';
                    durationField.style.display = 'none';
                    document.getElementById('reps').required = true;
                    document.getElementById('duration_seconds').required = false;
                } else {
                    repsField.style.display = 'none';
                    durationField.style.display = 'block';
                    document.getElementById('reps').required = false;
                    document.getElementById('duration_seconds').required = true;
                }
            }
            
            typeReps.addEventListener('change', toggleFields);
            typeTime.addEventListener('change', toggleFields);
            
            // Инициализация
            toggleFields();
        });
    </script>
</body>
</html>