<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimDateInformation extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = 'claim_date_informations';

    protected $fillable = [
        "from_date_or_current",
        "to_date",
        "description",
        "field_id",
        "qualifier_id",
        "physician_or_supplier_information_id"
    ];

    protected $with = ["field", "qualifier"];

    /**
     * ClaimDateInformation belongs to Field.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, "field_id");
    }

    /**
     * ClaimDateInformation belongs to Qualifier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function qualifier(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, "qualifier_id");
    }

    /**
     * ClaimDateInformation belongs to PhysicianOrSupplierInformations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function physicianOrSupplierInformation(): BelongsTo
    {
        return $this->belongsTo(PhysicianOrSupplierInformation::class);
    }
}
