<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EvaluationQuery extends Model
{
    protected $fillable = [
        'query',
        'expected_document_ids',
    ];

    protected $casts = [
        'expected_document_ids' => 'array',
    ];

    public function results(): HasMany
    {
        return $this->hasMany(EvaluationResult::class);
    }
}
