<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Policy;

class UpdatePolicyRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Policy::$rules;
        $rules['policy_number']='required|unique:policies,policy_number,'.$this->segment(3);
        return $rules;
    }

    public function attributes()
    {
        return [
            'policy_number'                => '保单编号',
        ];
    }
}
