<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class RegistrationsExport implements FromCollection, WithHeadings
{
    /**
     * @param array{status?: string, search?: string, class?: string, major?: string} $filters
     */
    public function __construct(
        protected array $filters = []
    ) {
    }

    /**
     * Return a collection of registrations.
     */
    public function collection(): Collection
    {
        $query = Registration::query()->select(
            'full_name',
            'nickname',
            'gender',
            'birth_place',
            'birth_date',
            'address',
            'city',
            'whatsapp',
            'class',
            'major',
            'organization_experience',
            'motivation',
            'status',
            'created_at'
        );

        $status = $this->filters['status'] ?? null;
        $search = trim((string) ($this->filters['search'] ?? ''));
        $class = trim((string) ($this->filters['class'] ?? ''));
        $major = trim((string) ($this->filters['major'] ?? ''));

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($class !== '') {
            $query->where('class', $class);
        }

        if ($major !== '') {
            $query->where('major', $major);
        }

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('full_name', 'like', "%{$search}%")
                    ->orWhere('whatsapp', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Define the headings row.
     */
    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Nama Panggilan',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat Lengkap',
            'Kota',
            'WhatsApp',
            'Kelas',
            'Jurusan',
            'Pengalaman Organisasi',
            'Alasan Bergabung',
            'Status',
            'Tanggal Daftar',
        ];
    }
}
