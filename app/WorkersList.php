<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class WorkersList extends Model
{
    use SoftDeletes, MultiTenantModelTrait;

    public $table = 'workers_lists';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'is_listed',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function workers()
    {
        return $this->belongsToMany(Worker::class);

    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');

    }
}
