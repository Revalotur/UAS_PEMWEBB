<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->take(3)->get();
        return view('welcomeuser', compact('feedbacks'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userId = session('user_id'); // Sesuaikan dengan cara Anda menyimpan session login

        // Cek apakah user sudah pernah memberikan feedback
        $feedback = Feedback::where('user_id', $userId)->first();

        if ($feedback) {
            // Update feedback sebelumnya
            $feedback->message = $request->message;
            $feedback->save();
            $message = 'Feedback berhasil diperbarui.';
        } else {
            // Tambahkan feedback baru
            Feedback::create([
                'user_id' => $userId,
                'message' => $request->message,
            ]);
            $message = 'Feedback berhasil dikirim.';
        }

        return redirect()->back()->with('success', $message);
    }
}
