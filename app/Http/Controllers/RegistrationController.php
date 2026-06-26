<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Services\RegistrationService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    protected RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Tampilkan form pendaftaran.
     */
    public function create(): View
    {
        $registrationOpen = $this->registrationService->isRegistrationOpen();
        return view('registration.create', compact('registrationOpen'));
    }

    /**
     * Simpan data pendaftaran.
     */
    public function store(StoreRegistrationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['parent_consent']);
        $data['status'] = \App\Models\Registration::STATUS_PENDING;

        try {
            $this->registrationService->createRegistration($data);
            return redirect()->route('registration.thankyou');
        } catch (\Exception $e) {
            return redirect()->route('registration.create')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Halaman terima kasih setelah submit.
     */
    public function thankyou(): View
    {
        return view('registration.thankyou');
    }

    /**
     * Tampilkan halaman cek status pendaftaran.
     */
    public function statusCheck(): View
    {
        return view('registration.status');
    }

    /**
     * Proses pencarian status pendaftaran publik.
     */
    public function findStatus(Request $request): View
    {
        $validated = $request->validate([
            'whatsapp' => ['required', 'string', 'min:10', 'max:20'],
            'birth_date' => ['required', 'date'],
        ]);

        $registration = $this->registrationService->findRegistrationForStatusCheck(
            preg_replace('/\D+/', '', $validated['whatsapp']) ?? '',
            $validated['birth_date']
        );

        return view('registration.status', [
            'searched' => true,
            'registration' => $registration,
            'searchInput' => [
                'whatsapp' => $validated['whatsapp'],
                'birth_date' => $validated['birth_date'],
            ],
        ]);
    }
}
