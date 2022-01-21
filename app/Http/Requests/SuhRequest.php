<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuhRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
    /**
     * Define validation rules to store method for resource creation
     *
     * @return array
     */
    public function createRules(): array
    {
        return [
            
            'name' => 'required|string|max:191',
            'district_id' => 'required|integer|exists:districts,id',
            'genid' => 'required',
            // 'tags' => 'required|array',
            // 'photo' => 'sometimes|files',
        ];
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
           
            'name' => 'required|string|max:191',
            'district_id' => 'required|integer|exists:districts,id',
            'genid' => 'required',
            // 'tags' => 'required|array',
            // 'photo' => 'sometimes|files',
        ];
    }
}
