<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\MacLocality;

class MacLocalityFeeRequired implements Rule
{
    protected $macLocalities;
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($macLocalities = [])
    {
        $this->macLocalities = $macLocalities;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $macL) {
            $macLocality = MacLocality::where([
                "mac"             => $macL['mac'],
                "locality_number" => $macL['locality_number'],
                "state"           => $macL['state'],
                "fsa"             => $macL['fsa'],
                "counties"        => $macL['counties']
            ])->first();
            if (!isset($macLocality)) {
                if (isset($macL['procedure_fees']['non_facility_price']) || 
                    isset($macL['procedure_fees']['facility_price']) ||
                    isset($macL['procedure_fees']['non_facility_limiting_charge']) ||
                    isset($macL['procedure_fees']['facility_limiting_charge']) ||
                    isset($macL['procedure_fees']['facility_rate']) ||
                    isset($macL['procedure_fees']['non_facility_rate'])) {
                    
                    $this->message = 'Error, cannot register a price without assigning a mac locality';
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
