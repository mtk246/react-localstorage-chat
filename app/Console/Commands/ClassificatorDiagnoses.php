<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Diagnoses\DiagnosesType;
use App\Enums\Interfaces\HasChildInterface;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use Illuminate\Console\Command;

final class ClassificatorDiagnoses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'classificator:diagnoses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /** Execute the console command. */
    public function handle(): int
    {
        $procedures = collect(json_decode(\File::get('database/data/Diagnoses.json')))
            ->map(function ($procedure) {
                $procedure->type = $procedure->type ?? '2';
                $procedure->clasifications = $this->getClassifications((string) $procedure->code, (int) $procedure->type);

                return (array) $procedure;
            });

        \File::put('database/data/Diagnoses.json', json_encode($procedures->toArray(), JSON_PRETTY_PRINT));

        return Command::SUCCESS;
    }

    private function getClassifications(string $code, int $type): array
    {
        $general = $this->getGeneral($code, $type);
        $specific = $this->getChildRange($code, $general);
        $subSpecific = $this->getChildRange($code, $specific);

        return [
            'general' => $general?->value,
            'specific' => $specific?->value,
            'sub_specific' => $subSpecific?->value,
        ];
    }

    private function getGeneral(string $code, int $type): ?HasChildInterface
    {
        return $this->getEnumByRange($code, DiagnosesType::tryFrom($type)->getChild()::cases());
    }

    private function getChildRange(string $code, ?ProcedureClassificationInterface $general): ?ProcedureClassificationInterface
    {
        $cases = $general?->getChild()
            ? $general->getChild()::cases()
            : null;

        return $this->getEnumByRange($code, $cases);
    }

    /** @param ProcedureClassificationInterface[]|null $cases */
    private function getEnumByRange(string $code, ?array $cases): ?ProcedureClassificationInterface
    {
        $value = null;

        if (is_null($cases)) {
            return $value;
        }

        foreach ($cases as $case) {
            $range = $case->getRange();

            if ($code >= $range->min && $code <= $range->max) {
                $value = $case;
            }
        }

        return $value;
    }
}
