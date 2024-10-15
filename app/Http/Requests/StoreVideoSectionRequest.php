<?php

namespace App\Http\Requests;

use App\Models\VideoSection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVideoSectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('video_section_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:191',
                'required',
            ],
        ];
    }
}
