<?php


namespace Reactor\Html\Forms\NodeFields;


use Kris\LaravelFormBuilder\Form;

class CreateForm extends Form {

    /**
     * Form options
     *
     * @var array
     */
    protected $formOptions = [
        'method' => 'POST'
    ];

    public function buildForm()
    {
        $this->add('name', 'text', [
            'help_block' => ['text' => trans('hints.nodefields_name')]
        ]);
        $this->add('type', 'select', [
            'rules'   => 'required',
            'choices' => $this->getFieldTypes(),
            'inline'  => true
        ]);

        $this->compose('Reactor\Html\Forms\NodeFields\EditForm');
    }

    /**
     * Returns the available types
     *
     * @return array
     */
    protected function getFieldTypes()
    {
        $types = config('hierarchy.type_map');

        foreach ($types as $key => $type)
        {
            $types[$key] = trans('nodefields.type_' . $key);
        }

        return $types;
    }

}