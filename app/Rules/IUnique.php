<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IUnique implements Rule
{
    /**
     * Cadena de texto con el nombre del campo para el mensaje
     * @var    string    $field_name
     */
    protected $field_name;

    /**
     * clase del modelo en el cual se realizara la validacion
     * @var    string    $model
     */
    protected $model;

    /**
     * id del cual se hara excepcion de coincidencia de ser necesario
     * @var    string    $id_exception
     */
    protected $id_exception;

    /**
     * nombre del atributo a considerar, si el valor dado es un objeto
     * @var    string    $id_exception
     */
    protected $attr;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($model, $field_name, $id_exception = null, $attr = '')
    {
        $this->model        = $model;
        $this->field_name   = $field_name;
        $this->id_exception = $id_exception;
        $this->attr         = $attr;
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
        $value = json_decode($value, true);
        if (is_array($value)) {
            $attrValue = $value[$this->attr];
            $record = $this->model::whereRaw("LOWER($this->attr) LIKE (?)", [strtolower("$attrValue")])->first();
        } else{
            $record = $this->model::whereRaw("LOWER($attribute) LIKE (?)", [strtolower("$value")])->first();
        }

        if ($record && $record->id == $this->id_exception) {
            return true;
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
        return __('The field ' . $this->field_name.' is already registered.');
    }
}
