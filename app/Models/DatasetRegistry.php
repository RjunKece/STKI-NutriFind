<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatasetRegistry extends Model
{
    protected $table = 'dataset_registries';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'provider',
        'source_url',
        'total_documents',
        'categories',
        'vocabulary_size',
        'indexed_documents',
        'last_indexed_at',
        'status',
        'version',
    ];

    protected $casts = [
        'categories' => 'array',
        'last_indexed_at' => 'datetime',
        'total_documents' => 'integer',
        'vocabulary_size' => 'integer',
        'indexed_documents' => 'integer',
    ];

    /**
     * Scope: hanya dataset aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Hitung jumlah kategori dari kolom JSON
     */
    public function getCategoryCountAttribute(): int
    {
        return is_array($this->categories) ? count($this->categories) : 0;
    }

    /**
     * Format total documents dengan separator ribuan
     */
    public function getFormattedTotalDocumentsAttribute(): string
    {
        return number_format($this->total_documents, 0, ',', '.');
    }

    /**
     * Format vocabulary size dengan separator ribuan
     */
    public function getFormattedVocabularySizeAttribute(): string
    {
        return number_format($this->vocabulary_size, 0, ',', '.');
    }
}
