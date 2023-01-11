<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Question extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'question';
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'question',
       'answer',
       'user_id',
       'edited_by'
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
  public function edited_by()
  {
      return $this->belongsTo(User::class,'edited_by');
  }
}
