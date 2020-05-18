<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Instruction extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait;

    public $table = 'instructions';

    protected $appends = [
        'import_pdf',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const CREATE_DOCUMENT_SELECT = [
        '1' => 'Import PDF',
        '2' => 'Create from App',
    ];

    protected $fillable = [
        'name',
        'category_id',
        'create_document',
        'description',
        'url',
        'user_id',
        'company_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getImportPdfAttribute()
    {
        return $this->getMedia('import_pdf');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
