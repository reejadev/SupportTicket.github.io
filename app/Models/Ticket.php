<?php

namespace App\Models;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','attachment','status','user_id'];

    public function replies()
{
    return $this->hasMany(Reply::class);
}
public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

}
