<?php

declare(strict_types=1);

namespace App\Http\Requests\Web;

use App\Enums\SearchType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'keyword' => 'nullable|string',
            'search_type' => ['nullable', 'string', new Enum(SearchType::class)],
            'limit' => 'nullable|integer|min:1|max:10',
        ];
    }

    protected function passedValidation()
    {
        $this->merge(['limit' => (int) $this->limit]);
    }
}
