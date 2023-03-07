<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TypeForm extends Form
{
    protected $clientValidationEnabled = false;

    public function buildForm()
    {
        $this->add(
            'amount',
            'text',
            [
                'label' => __('labels.type.form.amount_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.type.form.amount_holder'),
                ],
                'rules' => [
                    'required',
                ]
            ]
        )->add(
            'label',
            'text',
            [
                'label' => __('labels.type.form.label_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.type.form.label_holder'),
                ],
                'rules' => [
                    'required',
                ]
            ]
        )->add(
            'submit',
            'submit',
            [
                'label' => empty($this->getModel()->id) ? __('labels.actions.create') : __('labels.actions.update'),
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]
        );


        if ($this->getModel() && $this->getModel()->id) {
            $url = route('type_update', ['id' => $this->getModel()->id, 'lang' => app()->getLocale()]);
            empty($this->getModel()->deleted_at) ?: $this->remove('submit');
        } else {
            $url = route('type_store', ['lang' => app()->getLocale()]);
            $this->addAfter(
                'submit',
                'reset',
                'reset',
                [
                    'label' => __('labels.actions.reset'),
                    'attr' => [
                        'class' => 'btn iq-bg-danger'
                    ]
                ]
            );
        }

        $this->formOptions = [
            'method' => empty($this->getModel()->id) ? "POST" : "PUT",
            'url' => $url,
        ];
    }
}
