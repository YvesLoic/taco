<?php

namespace App\Forms;

use App\Models\City;
use Illuminate\Validation\Rules\Password;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    protected $clientValidationEnabled = false;

    /**
     * Users creation's form
     *
     * @return void
     */
    public function buildForm()
    {
        $rulesA = [
            "client" => __('labels.rules.client'),
            "driver" => __('labels.rules.driver'),
        ];
        $rulesSA = [
            "admin" => __('labels.rules.admin'),
            "client" => __('labels.rules.client'),
            "driver" => __('labels.rules.driver'),
            "super_admin" => __('labels.rules.super')
        ];

        $this->add(
            'first_name',
            'text',
            [
                'label' => __('labels.user.user_form.first_name_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.user.user_form.first_name_holder')
                ],
                'rules' => [
                    'required',
                    'string',
                ]
            ]
        )->add(
            'last_name',
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
            'phone',
            'text',
            [
                'label' => __('labels.user.user_form.phone_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.user.user_form.phone_holder'),
                ],
                'rules' => [
                    'required',
                    'min:9',
                    'max:15',
                    'string',
                    'unique:users',
                ]
            ]
        )->add(
            'email',
            'email',
            [
                'label' => __('labels.user.user_form.email_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.user.user_form.email_holder'),
                ],
                'rules' => [
                    'required',
                    'string',
                    'email',
                    'unique:users',
                ]
            ]
        )->add(
            'password',
            'password',
            [
                'label' => __('labels.user.user_form.password_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.user.user_form.password_holder')
                ],
                'rules' => [
                    Password::min(8)
                        ->letters()
                        ->numbers()
                        ->mixedCase()
                        ->symbols()
                ]
            ]
        )->add(
            'rule',
            'choice',
            [
                'label' => __('labels.user.user_form.rule_label'),
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices' => $this->getData('rule') == "admin" ? $rulesA : $rulesSA,
                'default_value' => empty($this->getModel()->id) ? 'client' : $this->getModel()->roles->pluck('name')[0]
            ]
        )->add(
            'city_id',
            'entity',
            [
                'empty_value' => __('labels.city.form.city_empty'),
                'class' => City::class,
                'label' => __('labels.city.form.city_label'),
                'property' => 'city',
                'query_builder' => function (City $city) {
                    return $city->where('deleted_at', null);
                },
                'attr' => [
                    'class' => 'form-control city-class',
                ],
                'rules' => [
                    'required',
                ]
            ]
        )->add(
            'picture',
            'file',
            [
                'label' => __('labels.user.user_form.picture_label'),
                'attr' => [
                    'class' => 'form-control',
                    // 'accept' => "image/jpg, image/jpeg, image/png",
                ],
                'rules' => [
                    'mimes:jpg,jpeg,png',
                    'max:2048'
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
            $url = route('user_update', ['id' => $this->getModel()->id, 'lang' => app()->getLocale()]);
            $this->modify('email', 'email', [
                'label' => __('labels.user.user_form.email_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.user.user_form.email_holder'),
                ],
                'rules' => [
                    'required',
                    'string',
                    'email',
                ]
            ], true);
            $this->modify('phone', 'text', [
                'label' => __('labels.user.user_form.phone_label'),
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => __('labels.user.user_form.phone_holder'),
                ],
                'rules' => [
                    'required',
                    'min:9',
                    'max:15',
                    'numeric',
                ]
            ], true);
            empty($this->getModel()->deleted_at) ?: $this->remove('submit');
            $this->remove('password');
            $this->getModel()->id != $this->getData('auth') ?: $this->remove('rule');
        } else {
            $url = route('user_store', ['lang' => app()->getLocale()]);
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
