<?php

namespace Reactor\Http\Forms\Nodes;


use Kris\LaravelFormBuilder\Form;

class EditNodeTypeForm extends Form {

    /**
     * Form options
     *
     * @var array
     */
    protected $formOptions = [
        'method' => 'PUT'
    ];

    public function buildForm()
    {
        $this->add('label', 'text', [
            'rules'      => 'required|max:255',
            'help_block' => ['text' => trans('hints.nodetype_label')]
        ]);
        $this->add('description', 'textarea');
        $this->add('hides_children', 'checkbox', ['inline' => true]);
        $this->add('visible', 'checkbox', ['inline' => true]);
        $this->add('taggable', 'checkbox', ['inline' => true]);
        $this->add('color', 'color', [
            'rules'         => 'required',
            'default_value' => '#000000',
            'help_block'    => ['text' => trans('hints.nodetype_color')]
        ]);
        $this->add('route_template', 'text', ['rules' => [
            'regex:/^(([A-Za-z\-])+:([A-Za-z\_])+(\.([A-Za-z\_])+)*(\/([A-Za-z\_])+(\.([A-Za-z\_])+)*)*)+$/'
        ]]);
        $this->add('preview_template', 'text');
    }

}