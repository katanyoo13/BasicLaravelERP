<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralLedgers extends Model
{
    use HasFactory;

    protected $primaryKey = 'ledger_id';

    protected $fillable = [
        'account_number', 
        'account_name', 
        'account_type', 
        'balance'
    ];

    // ความสัมพันธ์กับ JournalEntryDetails
    public function journalEntryDetails()
    {
        return $this->hasMany(JournalEntryDetails::class, 'account_number', 'account_number');
    }
}
