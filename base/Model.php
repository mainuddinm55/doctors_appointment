<?php

namespace app\base;

class Model
{
    const RULE_REQUIRED = 'required';
    const RULE_EMAIL = 'email';
    const RULE_MIN = 'min';
    const RULE_MAX = 'max';
    const RULE_MATCH = 'match';

    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }


    public function attributes(): array
    {
        return [];
    }

    public function labels(): array
    {
        return [];
    }

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function rules(): array
    {
        return [];
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if ( ! is_string($rule)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && ! $value) {
                    $this->addErrorByRule($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL
                    && ! filter_var(
                        $value,
                        FILTER_VALIDATE_EMAIL
                    )
                ) {
                    $this->addErrorByRule($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN
                    && strlen($value) < $rule['min']
                ) {
                    $this->addErrorByRule(
                        $attribute,
                        self::RULE_MIN,
                        ['min' => $rule['min']]
                    );
                }
                if ($ruleName === self::RULE_MAX
                    && strlen($value) > $rule['max']
                ) {
                    $this->addErrorByRule($attribute, self::RULE_MAX);
                }
                if ($ruleName === self::RULE_MATCH
                    && $value !== $this->{$rule['match']}
                ) {
                    $this->addErrorByRule(
                        $attribute,
                        self::RULE_MATCH,
                        ['match' => $rule['match']]
                    );
                }
            }
        }
        return empty($this->errors);
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL    => 'This field must be valid email address',
            self::RULE_MIN      => 'Min length of this field must be {min}',
            self::RULE_MAX      => 'Max length of this field must be {max}',
            self::RULE_MATCH    => 'This field must be the same as {match}',
        ];
    }

    public function errorMessage($rule)
    {
        return $this->errorMessages()[$rule];
    }

    protected function addErrorByRule(
        string $attribute,
        string $rule,
        $params = []
    ) {
        $params['field'] ??= $attribute;
        $errorMessage = $this->errorMessage($rule);
        foreach ($params as $key => $value) {
            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }
        $this->errors[$attribute][] = $errorMessage;
    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        $errors = $this->errors[$attribute] ?? [];
        return $errors[0] ?? '';
    }
}