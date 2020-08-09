<?php

namespace App;

use App\Notifications\MarkAsBestReply;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'channel_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function setBestReply(Reply $reply)
    {
        $this->reply_id = $reply->id;
        $this->save();

        if ($reply->owner->id != $this->user->id) {
            $reply->owner->notify(new MarkAsBestReply($reply->discussion));
        }
    }

    public function getBestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function scopeFilterByChannels($query)
    {
        if (request()->query('channel')) {
            $channel = Channel::where('slug', request()->query('channel'))->first();
            if ($channel) {
                return $query->where('channel_id', $channel->id);
            }
        }
        return $query;
    }
}
