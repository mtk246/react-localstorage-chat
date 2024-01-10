<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Contact.
 *
 * @property int $id
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $email
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $mobile
 * @property string $contactable_type
 * @property int $contactable_id
 * @property string|null $contact_name
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property Model|\Eloquent $contactable
 * @property Model|\Eloquent $profile
 * @property Model|\Eloquent $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Contact extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'contact_name',
        'phone',
        'fax',
        'email',
        'mobile',
        'billing_company_id',
        'contactable_type',
        'contactable_id',
    ];

    public function email(): Attribute
    {
        return Attribute::make(set: fn (?string $value) => empty($value) ? null : strtolower($value));
    }

    /**
     * Contact belongs to BillingCompany.
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * Contact morphs to models in contactable_type.
     */
    public function contactable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): MorphTo
    {
        return $this->morphTo(User::class, 'contactable_type', 'contactable_id');
    }

    public function profile(): MorphTo
    {
        return $this->morphTo(Profile::class, 'contactable_type', 'contactable_id');
    }
}
