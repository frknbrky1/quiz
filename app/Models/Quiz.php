<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;


class Quiz extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'description', 'status', 'slug', 'finished_at', 'admin_who_created', 'admin_who_update'];

    protected $dates = ['finished_at'];

    public function getFinishedAtAttribute($date) {
        return $date ? Carbon::parse($date) : null;
    }

    public function questions() {
        return $this->hasMany('App\Models\Question');
    }

    public function my_result() {
        return $this->hasOne('App\Models\Result')->where('user_id', auth()->user()->id);
    }

    protected $appends = ['details', 'my_rank'];

    public function getDetailsAttribute() {
        if($this->results()->count() > 0) {
            return [
                'avarage'   => round($this->results()->avg('point')),
                'join_count' => $this->results()->count()
            ];
        }
        return null;
    }

    public function getMyRankAttribute() {
        $rank = 0;
        foreach($this->results()->orderByDesc('point')->get() as $result) {
            $rank += 1;
            if($result->user_id == auth()->user()->id) {
                return $rank;
            }
        }
    }

    public function results() {
        return $this->hasMany('App\Models\Result');
    }

    public function topTen() {
        return $this->results()->orderByDesc('point')->take(10);
    }





    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
