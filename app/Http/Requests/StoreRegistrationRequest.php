<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    /**
     * Normalisasi input publik sebelum divalidasi.
     */
    protected function prepareForValidation(): void
    {
        if ($this->filled('whatsapp')) {
            $this->merge([
                'whatsapp' => preg_replace('/\D+/', '', (string) $this->input('whatsapp')),
            ]);
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // semua orang dapat mendaftar
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'full_name'               => 'required|string|max:255',
            'nickname'                => 'nullable|string|max:100',
            'gender'                  => 'required|in:L,P',
            'birth_place'             => 'required|string|max:255',
            'birth_date'              => 'required|date|before:tomorrow',
            'address'                 => 'required|string|max:1000',
            'city'                    => 'nullable|string|max:255',
            'province'                => 'nullable|string|max:255',
            'postal_code'             => 'nullable|string|max:10',
            'whatsapp'                => 'required|string|min:10|max:20|regex:/^[0-9]+$/|unique:registrations,whatsapp',
            'email'                   => 'nullable|email|max:255|unique:registrations,email',
            'class'                   => 'required|string|max:10',
            'major'                   => 'required|string|max:100',
            'medical_history'         => 'nullable|string|max:2000',
            'organization_experience' => 'nullable|string|max:2000',
            'motivation'              => 'required|string|min:20|max:2000',
            'parent_consent'          => 'accepted',
        ];
    }

    /**
     * Pesan validasi yang lebih jelas untuk pendaftar.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'whatsapp.unique' => 'Nomor WhatsApp ini sudah pernah digunakan untuk mendaftar.',
            'parent_consent.accepted' => 'Persetujuan orang tua / wali wajib disetujui sebelum mengirim pendaftaran.',
        ];
    }
}
