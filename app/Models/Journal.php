<?php

namespace App\Models;

use App\Models\Scopes\ByUserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy([ByUserScope::class])]
class Journal extends Model
{
    /** @use HasFactory<\Database\Factories\JournalFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'title',
        'description',
        'user_id'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
