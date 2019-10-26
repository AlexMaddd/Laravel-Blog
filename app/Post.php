<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = ['title', 'body'];

    protected $guarded = ['user_id']; // inverse of fillable, meaning this field cannot be touched, can also be an empty array
                                     // can also create own Parent Model instead of using Eloquents to inherit $fillable or $guarded

     public function user() // $comment->post->user
    {
        return $this->belongsTo(User::class);
    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
        ->groupBy('year', 'month')
        ->orderByRaw('min(created_at) desc')
        ->get()
        ->toArray();
    }

    public function scopeFilter($query, $filters)
    {
        // var_dump($filters);
        if($month = $filters['month'])
        {
            $query->whereMonth('created_at', Carbon::parse($month)->month); // converts month name to numerical value
        }

        if($year = $filters['year'])
        {
            $query->whereYear('created_at', $year);
        }
    }
    

    public function comments()
    {
        return $this->hasMany(Comment::class); //Comment::class returns Comment dir (App\Comment)
    }

    public function addComment($body)
    {
        // $this->comments() returns all comments related to a post
        // $this->comments()->create() sets id of post behind the scenes because of post / comment relationship
        $this->comments()->create(['body' => $body]);

        // Comment::create([

        //     'body' => $body,
        //     'post_id' => $this->id

        // ]);
    }

   
}
