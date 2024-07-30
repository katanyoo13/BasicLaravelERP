<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsPayables extends Model
{
    use HasFactory;

    protected $table = 'accounts_payables'; // ชื่อตารางในฐานข้อมูล

    protected $primaryKey = 'ap_id'; // คีย์หลักของตาราง
}
