<?php

namespace App\Forms;

use App\Models\Country;
use Kris\LaravelFormBuilder\Form;

class CityForm extends Form
{
    protected $clientValidationEnabled = false;

    public function buildForm()
    {
        $this->add(
            'country_id',
            'entity',
            [
                'label' => __('labels.city.form.country_label'),
                'class' => Country::class,
                'property' => 'name',
                'query_builder' => function (Country $country) {
                    return $country;
                },
                'attr' => [
                    'class' => 'form-control country',
                    'placeholder' => __('labels.city.form.country_holder'),
                ],
                'rules' => [
                    'required',
                    'max:50',
                ]
            ]
        )->add(
            'name',
            'text',
            [
                'label' => __('labels.city.form.city_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.city.form.city_holder'),
                ],
                'rules' => [
                    'required',
                    'max:50',
                    'unique:cities',
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
            $url = route('city_update', ['id' => $this->getModel()->id, 'lang' => app()->getLocale()]);
            empty($this->getModel()->deleted_at) ?: $this->remove('submit');
        } else {
            $url = route('city_store', ['lang' => app()->getLocale()]);
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
