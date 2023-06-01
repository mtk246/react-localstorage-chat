<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Type;
use App\Models\TypeCatalog;
use Illuminate\Database\Seeder;

final class DiagnosisRelatedGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = Type::updateOrCreate(['description' => 'Diagnosis related groups']);
        collect(json_decode(\File::get('database/data/claim/DiagnosisRelatedGroup.json')))
            ->chunk(1000)
            ->each(function ($chunk) use ($type) {
                $chunk->each(function ($item) use ($type) {
                    TypeCatalog::updateOrCreate(
                        [
                            'code' => $item->code,
                            'description' => $item->description,
                            'type_id' => $type->id,
                        ],
                        [
                            'code' => $item->code,
                            'description' => $item->description,
                        ]
                    );
                });
            });
    }
}