<?php

namespace App\Http\Requests;

use App\Rules\LatinName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreAssetRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['string', 'required', new LatinName()],
            'category_id' => ['string', 'required', 'exists:category,id'],
            'installed_date' => ['date','required'],
            'specification' => ['string','required'],
            'state' => ['integer', 'required', Rule::in([0, 1])],
            //0 : not available, 1 : available
        ];
    }
    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'message' => $errors,
            ],
            400
        ));
    }
}
