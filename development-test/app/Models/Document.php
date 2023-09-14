<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'documents';

    protected $fillable = [
        'title',
        'content',
        'signing'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $appends = [
        'signing_url'
    ];

    public function getSigningUrlAttribute()
    {
        if ($this->signing) {
            return asset('uploads/documents/' . $this->signing);
        }

        return null;
    }
}
