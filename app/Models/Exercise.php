<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'instructions',
        'muscle_group',
        'duration_seconds',
        'reps',
        'difficulty',
        'images'
    ];

    protected $casts = [
        'images' => 'array', // Это должно автоматически конвертировать JSON в массив
        'duration_seconds' => 'integer',
        'reps' => 'integer'
    ];

    // Метод для получения URL изображений
    public function getImageUrlsAttribute()
    {
        if (empty($this->images)) {
            return [];
        }

        $urls = [];
        foreach ((array)$this->images as $image) {
            $urls[] = asset('storage/' . $image);
        }
        return $urls;
    }
}