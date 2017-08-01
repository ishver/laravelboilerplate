<?php

namespace App\Http\Requests\Backend\Banner;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreUserRequest.
 */
class StoreBannerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasRole(1);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:191',
            'text'          => 'required',
            'sidetext'      => 'required',
            'url'           => 'required',
            //'image'         => 'required',
            //'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'order_number'  => 'required|numeric|min:0',
            'status'        => 'required|numeric',
            // 'email'    => ['required', 'email', 'max:191', Rule::unique('users')],
            // 'password' => 'required|min:6|confirmed',
        ];
    }
}
