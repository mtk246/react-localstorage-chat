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
            'file_name' => $this->getFileName(),
        ];
    }

    public function getUpdateData(int $paymentId): array
    {
        return [
            'name' => $this->get('name'),
            'date' => $this->get('date'),
            'file_name' => $this->getFileName(),
            'payment_id' => $this->get('payment_id', $paymentId),
        ];
    }

    public function getFileName(): string
    {
        $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png'];

        $file = $this->getFileByName('files', $this->get('file_name') ?? '', $allowedfileExtension);

        return $file ? $file->store('eobs') : '';
    }
}
