<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'tanggal', 'image', 'judul_detail', 'detail'];

}



// In app/Models/Community.php


