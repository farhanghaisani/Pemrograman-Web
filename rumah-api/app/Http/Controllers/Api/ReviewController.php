<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        // Ambil semua review dengan pagination
        $reviews = Review::latest()->paginate(5);

        // Kembalikan koleksi review sebagai resource
        return ReviewResource::collection($reviews);
    }
    
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'rumah_id' => 'required|exists:rumahs,id', // Validasi rumah_id
            'user_id' => 'required|exists:users,id', // Validasi user_id
            'review' => 'required|string', // Review wajib diisi dan bertipe string
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Simpan data review
        $review = Review::create([
            'rumah_id' => $request->rumah_id,
            'user_id' => $request->user_id,
            'review' => $request->review,
        ]);

        return new ReviewResource(true, 'Review berhasil disimpan!', $review);
    }

    public function show($id)
    {
        // Cari review berdasarkan ID
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review tidak ditemukan'], 404);
        }

        return new ReviewResource(true, 'Review ditemukan!', $review);
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'review' => 'required|string', // Review wajib diisi dan bertipe string
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cari review berdasarkan ID
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review tidak ditemukan'], 404);
        }

        // Update data review
        $review->update([
            'review' => $request->review,
        ]);

        return new ReviewResource(true, 'Review berhasil diupdate!', $review);
    }

    public function destroy($id)
    {
        // Cari review berdasarkan ID
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review tidak ditemukan'], 404);
        }

        // Hapus data review
        $review->delete();

        return response()->json(['message' => 'Review berhasil dihapus!'], 200);
    }
}
