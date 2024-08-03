<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntryDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'journal_id', 
        'account_number', 
        'debit', 
        'credit', 
        'description'
    ];

    // ความสัมพันธ์กับ Journals
    public function journal()
    {
        return $this->belongsTo(Journals::class, 'journal_id', 'journal_id');
    }

    // ความสัมพันธ์กับ GeneralLedgers
    public function ledgerAccount()
    {
        return $this->belongsTo(GeneralLedgers::class, 'account_number', 'account_number');
    }
}
