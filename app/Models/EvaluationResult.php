<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluationResult extends Model
{
    protected $fillable = [
        'evaluation_query_id',
        'retrieved_document_id',
        'rank',
        'relevance_score',
        'is_relevant',
    ];

    protected $casts = [
        'relevance_score' => 'double',
        'is_relevant' => 'boolean',
    ];

    public function evaluationQuery(): BelongsTo
    {
        return $this->belongsTo(EvaluationQuery::class);
    }

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class, 'retrieved_document_id');
    }
}
