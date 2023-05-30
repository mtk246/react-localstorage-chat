<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Interfaces\HasChildInterface;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Procedure\CPT\GeneralType;
use Illuminate\Console\Command;

final class ProcedureClassificator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'procedure:classificate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /** Execute the console command. */
    public function handle(): int
    {
        $procedures = collect(json_decode(\File::get('database/data/Procedures.json')))
            ->map(function ($procedure) {
                $procedure->type = 1;
                $procedure->clasifications = $this->getClassifications((string) $procedure->code);
                $procedure->description = html_entity_decode($procedure->description, ENT_QUOTES, 'UTF-8');

                return (array) $procedure;
            });

        \File::put('database/data/Procedures.json', json_encode($procedures->toArray(), JSON_PRETTY_PRINT));

        return Command::SUCCESS;
    }

    private function getClassifications(string $code): array
    {
        $general = $this->getGeneral($code);
        $specific = $this->getChildRange($code, $general);
        $subSpecific = $this->getChildRange($code, $specific);

        return [
            'general' => $general?->value,
            'specific' => $specific?->value,
            'sub_specific' => $subSpecific?->value,
        ];
    }

    private function getGeneral(string $code): ?HasChildInterface
    {
        $value = null;

        if ($code >= '0002M' && $code <= '0018M') {
            $value = GeneralType::CATEGORY_I;
        }

        return $value ?? $this->getEnumByRange($code, GeneralType::cases());
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
