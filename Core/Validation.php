<?php

namespace Core;

class Validation
{
    public $validations = [];

    public static function validate($rules, $data)
    {
        $validation = new self();

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $fieldValue = $data[$field];

                if ($rule == 'confirmed') {
                    $validation->$rule($field, $fieldValue, $data["{$field}_confirmation"]);
                } elseif (str_contains($rule, ':')) {
                    $temp = explode(':', $rule);
                    $rule = $temp[0];
                    $ruleArgument = $temp[1];
                    $validation->$rule($ruleArgument, $field, $fieldValue);
                } else {
                    $validation->$rule($field, $fieldValue);
                }
            }
        }

        return $validation;
    }

    private function addError($field, $error)
    {
        $this->validations[$field][] = $error;
    }

    private function getMessageForRule($rule, $field)
    {
        $messages = [
            'required' => [
                'id' => 'O ID da nota é obrigatório',
                'name' => 'O nome é obrigatório.',
                'password' => 'A senha é obrigatória.',
                'email' => 'O email é obrigatório.',
                'email_confirmation' => 'O email de confirmação é obrigatório.',
                'confirmed' => 'O email de confirmação é obrigatório.',
                'title' => 'O título é obrigatório.',
                'note' => 'A nota é obrigatória.',
            ],
            'email' => [
                'email' => 'O email está em formato inválido.',
            ],
            'unique' => [
                'email' => 'O email já está cadastrado.',
            ],
            'confirmed' => [
                'email_confirmation' => 'O email de confirmação deve estar igual.',
            ],
            'min' => [
                'password' => 'A nota precisa ter no mínimo 8 caracteres..',
                'title' => 'O título precisa ter no mínimo 3 caracteres.',
                'note' => 'A nota precisa ter no mínimo 3 caracteres.',
            ],
            'max' => [
                'title' => 'O título precisa ter no máximo 255 caracteres.',
            ],
            'strong' => [
                'password' => 'A senha precisa ter um caracter especial.',
            ],
        ];

        if (isset($messages[$rule][$field])) {
            return $messages[$rule][$field];
        }
    }

    private function unique($table, $field, $fieldValue)
    {
        if (strlen($fieldValue) == 0) {
            return;
        }

        $database = new Database(config('database'));

        $result = $database->query(
            query: "SELECT * FROM $table WHERE $field = :value",
            params: ['value' => $fieldValue]
        )->fetch();

        if ($result) {
            $this->addError($field, $this->getMessageForRule('unique', $field));
        }
    }

    private function required($field, $fieldValue)
    {
        if (strlen($fieldValue) == 0) {
            $this->addError($field, $this->getMessageForRule('required', $field));
        }
    }

    private function email($field, $fieldValue)
    {
        if (! filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, $this->getMessageForRule('email', $field));
        }
    }

    private function confirmed($field, $fieldValue, $confirmationValue)
    {
        if ($fieldValue != $confirmationValue) {
            $this->addError($field.'_confirmation', $this->getMessageForRule('confirmed', $field));
        }
    }

    private function min($min, $field, $fieldValue)
    {
        if (strlen($fieldValue) < $min) {
            $this->addError($field, $this->getMessageForRule('min', $field));
        }
    }

    private function max($max, $field, $fieldValue)
    {
        if (strlen($fieldValue) > $max) {
            $this->addError($field, $this->getMessageForRule('max', $field));
        }
    }

    private function strong($field, $fieldValue)
    {
        if (! strpbrk($fieldValue, "!@#$%^&**()*_-[\];.,/?|")) {
            $this->addError($field, $this->getMessageForRule('strong', $field));
        }
    }

    public function notPassed($customName = null)
    {
        $key = 'validations';

        if ($customName) {
            $key .= '_'.$customName;
        }

        flash()->push($key, $this->validations);

        return count($this->validations) > 0;
    }
}
