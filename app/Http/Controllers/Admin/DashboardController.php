<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\RegistrationService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function stats()
    {
        $statistics = $this->registrationService->getStatistics();
        $registrationOpen = $this->registrationService->isRegistrationOpen();
        $recent = $this->registrationService->getRecentRegistrations();
        
        return ApiResponse::success([
            'total' => $statistics['total'],
            'today' => $statistics['today'],
            'pending' => $statistics['pending'],
            'accepted' => $statistics['accepted'],
            'registration_open' => $registrationOpen,
            'recent' => $recent,
        ], 'Dashboard statistics retrieved successfully');
    }

    /**
     * Toggle status pendaftaran (buka/tutup).
     */
    public function toggleRegistration(Request $request)
    {
        $current = $this->registrationService->isRegistrationOpen();
        $this->registrationService->toggleRegistrationStatus(!$current);

        $newStatus = $this->registrationService->isRegistrationOpen();
        $message = $newStatus ? 'Pendaftaran telah DIBUKA.' : 'Pendaftaran telah DITUTUP.';
        
        return ApiResponse::success([
            'registration_open' => $newStatus,
        ], $message);
    }
}
