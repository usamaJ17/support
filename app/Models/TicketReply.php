<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TicketReply extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'ticket_reply';
    protected $primaryKey='reply_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'message',
        'level',
        'ticket_id ',
        'user_id ',
    ];
    /**
    * Get the User who is replying.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
