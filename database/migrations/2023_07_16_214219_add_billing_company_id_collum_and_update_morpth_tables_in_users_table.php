<?php

declare(strict_types=1);

use App\Models\Address;
use App\Models\Contact;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('billing_company_id')
            ->nullable()
            ->constrained('billing_companies')
            ->nullOnDelete()
            ->onUpdate('cascade');
        });

        Contact::query()->where('contactable_type', User::class)
            ->get()
            ->each(function (Contact $contact) {
                $contact->update([
                    'contactable_id' => $contact->user?->profile->id,
                    'contactable_type' => Profile::class,
                ]);
            });

        Address::query()->where('addressable_type', User::class)
            ->get()
            ->each(function (Address $address) {
                $address->update([
                    'addressable_id' => $address->user?->profile->id,
                    'addressable_type' => Profile::class,
                ]);
            });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn('billing_company_id');
        });

        Contact::query()->where('contactable_type', Profile::class)
            ->get()
            ->each(function (Contact $contact) {
                $contact->update([
                    'contactable_id' => $contact->profile->user->id,
                    'contactable_type' => User::class,
                ]);
            });

        Address::query()->where('addressable_type', Profile::class)
            ->get()
            ->each(function (Address $address) {
                $address->update([
                    'addressable_id' => $address->profile?->user->id,
                    'addressable_type' => User::class,
                ]);
            });
    }
};
