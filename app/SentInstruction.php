<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

/**
 * Class SentInstruction
 * @package App
 * @mixin Eloquent
 */
class SentInstruction extends Model
{
    use SoftDeletes, MultiTenantModelTrait;

    public $table = 'sent_instructions';

    protected $dates = [
        'validation_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'url',
        'validation_date',
        'user_id',
        'status_id',
        'workers_list_id',
        'instruction_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getValidationDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setValidationDateAttribute($value): void
    {
        $this->attributes['validation_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function workers_list(): BelongsTo
    {
        return $this->belongsTo(WorkersList::class, 'workers_list_id');
    }

    public function instruction(): BelongsTo
    {
        return $this->belongsTo(Instruction::class, 'instruction_id');
    }

    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(Worker::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
