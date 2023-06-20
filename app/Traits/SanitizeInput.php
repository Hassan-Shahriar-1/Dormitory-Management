<?php

namespace App\Traits;

trait SanitizeInput
{
    /**
     * @Override Illuminate\Foundation\Http\FormRequest::getValidatorInstance
     */
    protected function getValidatorInstance()
    {
        $this->sanitizeInput();
        return parent::getValidatorInstance();
    }

    /**
     * Sanitize the input.
     */
    protected function sanitizeInput()
    {
        if (method_exists($this, 'sanitize')) {
            $input = $this->all();
            $sanitizedInput = $this->container->call([$this, 'sanitize'], ['input' => $input]);
            $input = array_merge($input, $sanitizedInput);
            $this->replace($input);
        }
    }
}
