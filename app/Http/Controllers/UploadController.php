<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserFiles;
use App\Models\PengumumanPdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PdfController;

class UploadController extends Controller
{
    public function uploadFile(Request $request, $field)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);
    
        $file = $request->file('file');
        $filename = uniqid() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/dokumen', $filename, 'public');
    
        $user = Auth::user();
    
        $user->userFiles()->updateOrCreate(
            ['file_name' => $field],
            ['file_path' => $path]
        );
    
        return response()->json(['success' => true]);
    }
    
}