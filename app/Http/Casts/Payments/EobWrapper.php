<?php

declare(strict_types=1);

namespace App\Http\Casts\Payments;

use App\Http\Casts\CastsRequest;

final class EobWrapper extends CastsRequest
{
    public function getId(): int
    {
        return $this->getInt('id', 0);
    }

    public function getEobData(): array
    {
        return [
            'name' => $this->get('name'),
            'date' => $this->get('date'),
            'file_name' => $this->getFileName() ?? '',
        ];
    }

    public function getUpdateData(int $paymentId): array
    {
        $data = [
            'name' => $this->get('name'),
            'date' => $this->get('date'),
            'payment_id' => $this->get('payment_id', $paymentId),
        ];

        $file = $this->getFileName();

        if ($file) {
            $data['file_name'] = $file;
        }

        return $data;
    }

    public function getFileName(): ?string
    {
        $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png'];

        $file = $this->getFileByName('files', $this->get('file_name') ?? '', $allowedfileExtension);

        if (is_null($file)) {
            return null;
        }

        $file->store('eobs');

        return $file->hashName();
    }
}
