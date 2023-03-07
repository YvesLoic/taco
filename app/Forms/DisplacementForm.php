<?php

namespace App\Forms;

use App\Models\Car;
use App\Models\User;
use Kris\LaravelFormBuilder\Form;

class DisplacementForm extends Form
{
    protected $clientValidationEnabled = false;

    public function buildForm()
    {
        $this->add(
            'user_id',
            'entity',
            [
                'class' => User::class,
                'empty_value' => '',
                'label' => '',
                'property' => function (User $user) {
                    return $user->first_name . ' ' . $user->last_name;
                },
                'query_builder' => function (User $user) {
                    return $user->where('deleted_at', null);
                },
                'attr' => [
                    'class' => 'form-control',
                ],
                'rules' => [
                    'required',
                    'string',
                ]
            ]
        )->add(
            'to',
            'text',
            [
                'label' => __('labels.user.user_form.last_name_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.user.user_form.last_name_holder')
                ],
                'rules' => [
                    'required',
                    'string',
                ]
            ]
        )->add(
            'from',
            'text',
            [
                'label' => __('labels.user.user_form.last_name_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.user.user_form.last_name_holder')
                ],
                'rules' => [
                    'required',
                    'string',
                ]
            ]
        )->add(
            'car_id',
            'entity',
            [
                'class' => Car::class,
                'empty_value' => '',
                'label' => '',
                'property' => 'model',
                'query_builder' => function (Car $car) {
                    return $car->where('deleted_at', null);
                },
                'attr' => [
                    'class' => 'form-control',
                ],
                'rules' => [
                    'required',
                    'string',
                ]
            ]
        );
    }
}
