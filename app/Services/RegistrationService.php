<?php

namespace App\Services;

use App\Models\Registration;
use App\Models\Setting;
use Illuminate\Pagination\LengthAwarePaginator;

class RegistrationService
{
    /**
     * Get all registrations with pagination and optional filtering.
     */
    public function getAllRegistrations(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = Registration::orderBy('created_at', 'desc');

        $status = $filters['status'] ?? null;
        $search = trim((string) ($filters['search'] ?? ''));
        $class = trim((string) ($filters['class'] ?? ''));
        $major = trim((string) ($filters['major'] ?? ''));

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

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Create a new registration.
     */
    public function createRegistration(array $data): Registration
    {
        // Check if registration is open
        if (!$this->isRegistrationOpen()) {
            throw new \Exception('Pendaftaran saat ini telah ditutup. Silakan coba lagi nanti.');
        }

        return Registration::create($data);
    }

    /**
     * Cari status pendaftaran untuk kebutuhan publik.
     */
    public function findRegistrationForStatusCheck(string $whatsapp, string $birthDate): ?Registration
    {
        return Registration::query()
            ->where('whatsapp', $whatsapp)
            ->whereDate('birth_date', $birthDate)
            ->latest('created_at')
            ->first();
    }

    /**
     * Update registration status.
     */
    public function updateStatus(int $id, string $status): Registration
    {
        $registration = Registration::findOrFail($id);
        
        if (!in_array($status, [Registration::STATUS_PENDING, Registration::STATUS_ACCEPTED, Registration::STATUS_REJECTED])) {
            throw new \InvalidArgumentException('Status tidak valid.');
        }

        $registration->status = $status;
        $registration->save();

        return $registration;
    }

    /**
     * Delete a registration.
     */
    public function deleteRegistration(int $id): void
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();
    }

    /**
     * Delete multiple registrations based on status filter.
     */
    public function deleteBulkRegistrations(string $filter = 'all'): int
    {
        if ($filter === 'all') {
            $count = Registration::count();
            Registration::truncate();
            return $count;
        }

        if (!in_array($filter, [Registration::STATUS_PENDING, Registration::STATUS_ACCEPTED, Registration::STATUS_REJECTED])) {
            throw new \InvalidArgumentException('Filter tidak valid.');
        }

        $count = Registration::where('status', $filter)->count();
        Registration::where('status', $filter)->delete();
        
        return $count;
    }

    /**
     * Get registration statistics.
     */
    public function getStatistics(): array
    {
        return [
            'total' => Registration::count(),
            'today' => Registration::whereDate('created_at', today())->count(),
            'pending' => Registration::where('status', Registration::STATUS_PENDING)->count(),
            'accepted' => Registration::where('status', Registration::STATUS_ACCEPTED)->count(),
            'rejected' => Registration::where('status', Registration::STATUS_REJECTED)->count(),
        ];
    }

    /**
     * Check if registration is currently open.
     */
    public function isRegistrationOpen(): bool
    {
        return Setting::get('registration_open', '0') === '1';
    }

    /**
     * Toggle registration open/close status.
     */
    public function toggleRegistrationStatus(bool $isOpen): void
    {
        Setting::set('registration_open', $isOpen ? '1' : '0');
    }

    /**
     * Get recent registrations.
     */
    public function getRecentRegistrations(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return Registration::orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Ambil opsi filter sederhana untuk panel admin.
     *
     * @return array{classes: array<int, string>, majors: array<int, string>}
     */
    public function getFilterOptions(): array
    {
        return [
            'classes' => Registration::query()
                ->select('class')
                ->whereNotNull('class')
                ->distinct()
                ->orderBy('class')
                ->pluck('class')
                ->filter()
                ->values()
                ->all(),
            'majors' => Registration::query()
                ->select('major')
                ->whereNotNull('major')
                ->distinct()
                ->orderBy('major')
                ->pluck('major')
                ->filter()
                ->values()
                ->all(),
        ];
    }
}
