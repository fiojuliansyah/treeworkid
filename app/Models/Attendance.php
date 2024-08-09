<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function overtimes()
    {
        return $this->hasMany(Overtime::class);
    }

    public function minutes()
    {
        return $this->hasMany(Minute::class);
    }

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }

    protected $casts = [
        'date' => 'datetime',
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
      ];
}
