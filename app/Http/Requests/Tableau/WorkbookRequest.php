<?php

declare(strict_types=1);

namespace App\Http\Requests\Tableau;

use App\Enums\Tableau\WorkbookGroupType;
use App\Enums\Tableau\WorkbookType;
use App\Http\Casts\Tableau\WorkbookFilterCast;
use App\Http\Requests\Traits\HasCastedClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class WorkbookRequest extends FormRequest
{
    use HasCastedClass;

    protected string $castedClass = WorkbookFilterCast::class;

    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'filter' => 'nullable|array',
            'filter.name' => 'nullable|string',
            'filter.type' => ['nullable', new Enum(WorkbookType::class)],
            'filter.group' => ['nullable', new Enum(WorkbookGroupType::class)],
        ];
    }
}
