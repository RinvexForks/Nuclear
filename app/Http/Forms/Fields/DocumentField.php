<?php

namespace Reactor\Http\Forms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;

class DocumentField extends FormField {

    /**
     * Get the template, can be config variable or view path
     *
     * @return string
     */
    protected function getTemplate()
    {
        return 'fields.document';
    }

}