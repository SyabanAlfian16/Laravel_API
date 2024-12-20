<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Validator;

class ContentController extends Controller
{
    // Get all contents
    public function index()
    {
        $contents = Content::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar Content',
            'data' => $contents
        ]);
    }

    // Create new content
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()
            ], 422);
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('content-images', 'public');
        }

        $content = Content::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $imagePath,
            'status' => $request->status ?? 'draft'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Content berhasil dibuat',
            'data' => $content
        ], 201);
    }

    // Get specific content
    public function show($id)
    {
        $content = Content::find($id);
        
        if (!$content) {
            return response()->json([
                'success' => false,
                'message' => 'Content tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $content
        ]);
    }

    // Update content
    public function update(Request $request, $id)
    {
        $content = Content::find($id);

        if (!$content) {
            return response()->json([
                'success' => false,
                'message' => 'Content tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()
            ], 422);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($content->image) {
                Storage::disk('public')->delete($content->image);
            }
            $image = $request->file('image');
            $imagePath = $image->store('content-images', 'public');
            $content->image = $imagePath;
        }

        $content->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'status' => $request->status ?? $content->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Content berhasil diupdate',
            'data' => $content
        ]);
    }

    // Delete content
    public function destroy($id)
    {
        $content = Content::find($id);

        if (!$content) {
            return response()->json([
                'success' => false,
                'message' => 'Content tidak ditemukan'
            ], 404);
        }

        // Delete image if exists
        if ($content->image) {
            Storage::disk('public')->delete($content->image);
        }

        $content->delete();

        return response()->json([
            'success' => true,
            'message' => 'Content berhasil dihapus'
        ]);
    }
} 