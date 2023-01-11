<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'agent_id',
        'name',
        'email',
        'subject',
        'department',
        'service',
        'priority',
        'message',
        'status'
    ];
    /**
    * Get the User who is replying.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
    * Get the User who is replying.
    */
    public function agent()
    {
        return $this->belongsTo(User::class);
    }
}
