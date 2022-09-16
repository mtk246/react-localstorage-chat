<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


class ClaimService extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "from_service",
        "to_service",
        "price",
        "claim_id",
        "std_id",
        "modifier_id",
        "procedure_id",
        "rev_center_id",
        "place_of_service_id",
        "type_of_service_id",
        "diagnostic_pointer_id"
    ];

    /**
     * ClaimService belongs to Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * ClaimService belongs to Modifier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modifier()
    {
        return $this->belongsTo(Modifier::class);
    }

    /**
     * ClaimService belongs to Procedure.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }

    /**
     * ClaimService belongs to RevCenter.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function revCenter()
    {
        return $this->belongsTo(RevCenter::class);
    }

    /**
     * ClaimService belongs to PlaceOfService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function placeOfService()
    {
        return $this->belongsTo(PlaceOfService::class);
    }

    /**
     * ClaimService belongs to TypeOfService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeOfService()
    {
        return $this->belongsTo(TypeOfService::class);
    }

    /**
     * ClaimService belongs to DiagnosticPointer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diagnosticPointer()
    {
        return $this->belongsTo(DiagnosticPointer::class);
    }

    /**
     * ClaimService belongs to Std.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function std()
    {
        return $this->belongsTo(Std::class);
    }
}
