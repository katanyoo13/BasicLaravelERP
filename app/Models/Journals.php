<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journals extends Model
{
    use HasFactory;

    protected $primaryKey = 'journal_id';

    protected $fillable = [
        'entry_date', 
        'description', 
        'total_debit', 
        'total_credit'
    ];

    // ความสัมพันธ์กับ JournalEntryDetails
    public function journalEntryDetails()
    {
        return $this->hasMany(JournalEntryDetails::class, 'journal_id', 'journal_id');
    }
}
