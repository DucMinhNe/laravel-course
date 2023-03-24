<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

// Registered with: Route::resource('photos', PhotoController::class);
class PhotoController extends Controller
{
    public function index()                    { return Photo::paginate(15); }
    public function create()                   { return view('photos.create'); }
    public function store(Request $request)    { /* validate + Photo::create */ }
    public function show(Photo $photo)         { return $photo; }
    public function edit(Photo $photo)         { return view('photos.edit', compact('photo')); }
    public function update(Request $r, Photo $photo) { /* validate + $photo->update */ }
    public function destroy(Photo $photo)      { $photo->delete(); return response()->noContent(); }
}
