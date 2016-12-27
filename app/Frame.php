<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    public function feed()
    {
        return $this->belongsTo(App\Feed::class);
    }
}
