<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class transactions extends Model
{
    protected $fillable = ['user_id', 'book_id', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

    public Function user() { return $this->belongsTo(User::class); }
    public Function book() { return $this->belongsTo(Book::class); }

}
