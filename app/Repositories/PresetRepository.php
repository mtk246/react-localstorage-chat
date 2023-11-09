<?php

namespace App\Repositories;

use App\Models\Preset;

final class PresetRepository
{
    public function create(array $data)
    {
        return Preset::create([
            'name' => $data['name'],
            'filter' => $data['filter'],
            'user_id' => \Auth::user()->id,
        ]);
    }

    public function update(array $data, string $id)
    {
        $preset = Preset::find($id);

        $preset->update([
            // 'uuid' => $data['uuid'],
            'name' => $data['name'],
            'filter' => $data['filter'],
            'user_id' => \Auth::user()->id,
        ]);

        return $preset;
    }

    public function show(string $id)
    {
        return Preset::find($id);
    }

    public function destroy(string $id)
    {
        $preset = Preset::find($id);
        return $preset->delete();
    }
}
