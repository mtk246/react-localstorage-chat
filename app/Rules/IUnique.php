<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IUnique implements Rule
{
    /**
     * Cadena de texto con el nombre del campo para el mensaje.
     *
     * @var string
     */
    protected $field_name;

    /**
     * clase del modelo en el cual se realizara la validacion.
     *
     * @var string
     */
    protected $model;

    /**
     * id del cual se hara excepcion de coincidencia de ser necesario.
     *
     * @var string
     */
    protected $id_exception;

    /**
     * nombre del atributo a considerar, si el valor dado es un objeto.
     *
     * @var string
     */
    protected $attr;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($model, $field_name, $id_exception = null, $attr = '')
    {
        $this->model = $model;
        $this->field_name = $field_name;
        $this->id_exception = $id_exception;
        $this->attr = $attr;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $val = json_decode($value, true);
        if (is_array($val)) {
            $attrValue = $val[$this->attr];
            $record = $this->model::whereRaw("LOWER($this->attr) LIKE (?)", [strtolower("$attrValue")])
                                  ->whereNot('id', $this->id_exception)->first();
        } else {
            $record = $this->model::whereRaw("LOWER($attribute) LIKE (?)", [strtolower("$value")])
                                  ->whereNot('id', $this->id_exception)->first();
        }

        return ($record) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The field '.$this->field_name.' is already registered.');
    }
}
