<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'title',
        'category',
        'description',
        'nutrition_info',
    ];

    /**
     * Gabungkan semua teks dokumen untuk keperluan indexing IR
     * Menggabungkan title, category, description, dan nutrition_info
     */
    public function getFullTextAttribute(): string
    {
        return implode(' ', [
            $this->title,
            $this->category,
            $this->description,
            $this->nutrition_info,
        ]);
    }
}
