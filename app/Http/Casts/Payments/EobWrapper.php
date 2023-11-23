<?php

declare(strict_types=1);

namespace App\Http\Casts\Payments;

use App\Http\Casts\CastsRequest;

final class EobWrapper extends CastsRequest
{
    public function getData(): array
    {
        return [
            'name' => $this->get('name'),
            'date' => $this->get('date'),
            'file_name' => $this->getFileName(),
        ];
    }

    public function getFileName(): string
    {
        $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png'];

        $file = $this->getFileByName('eob_files', $this->get('file_name') ?? '', $allowedfileExtension);

        return $file ? $file->store('eobs') : '';
    }
}
