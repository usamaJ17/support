<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailModel extends Model
{
    use HasFactory;
    protected $table = 'email';
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subject',
        'body',
        'to',
        'by',
    ];
    /**
    * Get the User who is replying.
    */
    public function user()
    {
        return $this->belongsTo(User::class ,'by');
    }


}
