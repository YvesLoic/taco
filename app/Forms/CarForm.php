<?php

namespace App\Forms;

use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\Form;

class CarForm extends Form
{
    protected $clientValidationEnabled = false;

    public function buildForm()
    {
        $this->add(
            'color',
            'text',
            [
                'label' => __('labels.car.form.color_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.car.form.color_holder'),
                ],
                'rules' => [
                    'required',
                    'string',
                ]
            ]
        )->add(
            'gray_card',
            'text',
            [
                'label' => __('labels.car.form.gray_cars_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.car.form.gray_card_holder'),
                ],
                'rules' => [
                    'required',
                    'string',
                ]
            ]
        )->add(
            'model',
            'text',
            [
                'label' => __('labels.car.form.model_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.car.form.model_holder'),
                ],
                'rules' => [
                    'required',
                    'string',
                ]
            ]
        )->add(
            'registration_number',
            'text',
            [
                'label' => __('labels.car.form.registration_number_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.car.form.registration_number_holder'),
                ],
                'rules' => [
                    'required',
                    'string',
                ]
            ]
        )->add(
            'type_id',
            'entity',
            [
                'empty_value' => __('labels.car.form.type_empty'),
                'class' => Type::class,
                'label' => __('labels.car.form.type_label'),
                'property' => 'label',
                'query_builder' => function (Type $type) {
                    return $type;
                },
                'attr' => [
                    'class' => 'form-control type-class',
                ],
                'rules' => [
                    'required',
                ]
            ]
        )->add(
            'user_id',
            'entity',
            [
                'empty_value' => __('labels.car.form.user_empty'),
                'class' => User::class,
                'label' => __('labels.car.form.user_label'),
                'property' => function (User $user) {
                    return $user->first_name . ' ' . $user->last_name;
                },
                'query_builder' => function (User $user) {
                    $users = User::with('roles')->get(['id', 'first_name', 'last_name']);
                    return array_filter(iterator_to_array($users), function ($user) {
                        return $user->roles->pluck('name')[0] == 'driver';
                    });
                },
                'attr' => [
                    'class' => 'form-control owner',
                ],
                'rules' => [
                    'required',
                ]
            ]
        )->add(
            'pictures1',
            'static',
            [
                'label' => __('labels.car.form.car_pics'),
                'tag' => 'div',
                'attr' => [
                    'class' => 'input-images',
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
            $url = route('car_update', ['id' => $this->getModel()->id, 'lang' => app()->getLocale()]);
            empty($this->getModel()->deleted_at) ?: $this->remove('submit');
        } else {
            $url = route('car_store', ['lang' => app()->getLocale()]);
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
            'enctype' => 'multipart/form-data',
        ];
    }
}
