<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Worker extends Model
{
    use SoftDeletes, MultiTenantModelTrait;

    public $table = 'workers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');

    }
}
