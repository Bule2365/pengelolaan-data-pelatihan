<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificateTrainee;
use App\Models\Trainee;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian
    
        // Query untuk mengambil data sertifikat dengan relasi trainee
        $query = CertificateTrainee::with('trainee')->orderBy('issue_date', 'desc');
    
        // Jika ada pencarian berdasarkan nama trainee
        if ($search) {
            $query->whereHas('trainee', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%'); // Cari berdasarkan nama trainee
            });
        }
    
        $certificates = $query->paginate(10); // Pagination tetap diterapkan
        return view('admin.certificates.index', compact('certificates'));
    }    

    public function create()
    {
        $trainees = Trainee::all();
        return view('admin.certificates.create', compact('trainees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'issue_date' => 'required|date',
            'trainee_id' => 'required|exists:trainees,id',
            'certificate_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->certificate_image->extension();  
        $request->certificate_image->move(public_path('images'), $imageName);

        CertificateTrainee::create([
            'issue_date' => $request->issue_date,
            'trainee_id' => $request->trainee_id,
            'certificate_image' => $imageName,
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created and uploaded successfully.');
    }

    public function show($id)
    {
        $certificate = CertificateTrainee::with('trainee')->findOrFail($id);
        return view('admin.certificates.show', compact('certificate'));
    }

    public function destroy($id)
    {
        $certificate = CertificateTrainee::findOrFail($id);

        // Menghapus file gambar sertifikat jika ada
        if (file_exists(public_path('images/' . $certificate->certificate_image))) {
            unlink(public_path('images/' . $certificate->certificate_image));
        }

        // Menghapus data sertifikat dari database
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}