<?php

declare(strict_types=1);

namespace App\Models\Tableau;

use App\Enums\Tableau\WorkbookGroupType;
use App\Enums\Tableau\WorkbookType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Workbooks extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'tableau_workbooks';

    /** @var string[] */
    protected $fillable = [
        'name',
        'icon',
        'description',
        'url',
        'type',
        'group',
    ];

    /** @var string[] */
    protected $casts = [
        'type' => WorkbookType::class,
        'group' => WorkbookGroupType::class,
    ];
}
