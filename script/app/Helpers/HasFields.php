<?php

namespace App\Helpers;

use App\Models\SignupFields;
use App\Helpers\HasUploader;

trait HasFields
{
    use HasUploader;

    public $types = ['text', 'number', 'email', 'tel', 'textarea', 'file', 'date', 'select', 'radio', 'checkbox'];

    private $signupFields = null;

    public function setFields()
    {
        $this->signupFields = SignupFields::where('isActive', true)
            ->orderBy('order', 'ASC')
            ->get(['id', 'label', 'type', 'data', 'isRequired']);
    }

    public function getFields($request, $isArray = true)
    {
        $dataFields = [];

        if ($isArray) {
            $arrayFields = $request->fields;
        } else {
            $arrayFields = json_decode($request->fields, true);
        }

        \Log::debug($request);
        \Log::debug($arrayFields);

        if (isset($this->signupFields) && count($this->signupFields) > 0) {
            foreach ($arrayFields as $key => $value) {
                $field = $arrayFields[$key];

                if (is_file($field)) {
                    $dataFields[$key] = $this->upload($request, 'fields.' . $key);
                } else {
                    $dataFields[$key] = $field;
                }
            }
        }

        return $dataFields;
    }
}