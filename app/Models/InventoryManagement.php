<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryManagement extends Model
{
    use HasFactory;

    protected $table = 'inventory_managements'; // ตรวจสอบชื่อตารางในฐานข้อมูล
}
