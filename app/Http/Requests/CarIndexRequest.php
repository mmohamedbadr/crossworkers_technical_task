<?php

namespace App\Http\Requests;


class CarIndexRequest extends BaseRequest
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
        return [
            'per_page'=>'sometimes|integer|min:1|max:200',
            'current_page'=>'sometimes|integer|min:1',
            'brand_id'=>'sometimes|array|min:1|max:100',
            'brand_id.*'=>'sometimes|integer|min:1|exists:brands,id,deleted_at,NULL',
            'category_id'=>'sometimes|array|min:1|max:100',
            'category_id.*'=>'sometimes|integer|min:1|exists:categories,id,deleted_at,NULL',
            'carmodel_id'=>'sometimes|array|min:1|max:100',
            'carmodel_id.*'=>'sometimes|integer|min:1|exists:carmodels,id,deleted_at,NULL',
            'has_gas_economy'=>'sometimes|boolean',
            'has_abs'=>'sometimes|boolean',
            'engine'=>'sometimes|array|min:1|max:4',
            'engine.horsepower'=>'integer|min:1|max:1000',
            'engine.capacity'=>'integer|min:400|max:10000',
            'doors'=>'sometimes|array|min:1|max:2',
            'doors.*'=>'integer|in:2,4',
            'transimation'=>'sometimes|array|min:1|max:5',
            'transimation.*'=>'string|min:1|max:20',
            'sort_by'=>'string|min:1|max:30|in:max_speed',
            'sort_order'=>'string|in:asc,desc'
        ];
    }
}
