<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistrationsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistrationController extends Controller
{
    // List all registrations
    public function index()
    {
        $registrations = Registration::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.registrations.index', compact('registrations'));
    }

    // Export to Excel
    public function exportExcel()
    {
        return Excel::download(new RegistrationsExport, 'registrations.xlsx');
    }

    // Export single registration to PDF
    public function exportPdf(int $id)
    {
        $registration = Registration::findOrFail($id);
        $pdf = Pdf::loadView('admin.registrations.pdf', compact('registration'));
        return $pdf->download("registration_{$id}.pdf");
    }

    // Update status (e.g., accepted/rejected)
    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);
        $registration = Registration::findOrFail($id);
        $registration->status = (string) $request->input('status');
        $registration->save();
        return redirect()->back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    // Hapus satu pendaftar
    public function destroy(int $id)
    {
        $registration = Registration::findOrFail($id);
        $name = $registration->full_name;
        $registration->delete();
        return redirect()->back()->with('success', "Data pendaftar \"{$name}\" berhasil dihapus.");
    }

    // Hapus semua pendaftar (dengan filter opsional by status)
    public function destroyBulk(Request $request)
    {
        $request->validate([
            'filter' => 'nullable|in:all,pending,accepted,rejected',
        ]);

        $filter = $request->input('filter', 'all');

        if ($filter === 'all') {
            $count = Registration::count();
            Registration::truncate();
            $message = "Semua {$count} data pendaftar berhasil dihapus.";
        } else {
            $count = Registration::where('status', $filter)->count();
            Registration::where('status', $filter)->delete();
            $label = ['pending' => 'Pending', 'accepted' => 'Diterima', 'rejected' => 'Ditolak'];
            $message = "{$count} data dengan status \"{$label[$filter]}\" berhasil dihapus.";
        }

        return redirect()->route('admin.registrations.index')->with('success', $message);
    }
}
