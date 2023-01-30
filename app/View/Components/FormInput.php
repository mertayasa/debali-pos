<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $fieldType;
    public $fieldName;
    public $defaultValue;
    public $optionList;
    public $fieldTitle;
    public $labelClass;
    public $labelAttribute;
    public $inputClass;
    public $inputAttribute;
    public $hint;
    public $formColWidth;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldType, $fieldName, $defaultValue = null, $optionList = [], $fieldTitle = null, $labelClass = '', $labelAttribute = [], $inputClass = '', $inputAttribute = [], $hint = '', $formColWidth = ''){
        $this->fieldType = $fieldType;
        $this->fieldName = $fieldName;
        $this->defaultValue = $defaultValue;
        $this->optionList = $optionList;
        $this->fieldTitle = $fieldTitle;
        $this->labelClass = $labelClass;
        $this->labelAttribute = $labelAttribute;
        $this->inputClass = $inputClass;
        $this->inputAttribute = $inputAttribute;
        $this->hint = $hint;
        $this->formColWidth = $formColWidth;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-input');
    }
}
