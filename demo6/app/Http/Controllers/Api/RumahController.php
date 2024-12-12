<?php

namespace App\Http\Controllers\Api;

// Import model Rumah
use App\Models\Rumah;

use Illuminate\Http\Request;

// Import resource RumahResource (create if necessary)
use App\Http\Controllers\Controller;

// Import Http request
use App\Http\Resources\RumahResource;

// Import facade Validator
use Illuminate\Support\Facades\Validator;

// Import facade Storage
use Illuminate\Support\Facades\Storage;

class RumahController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all rumahs
        $rumahs = Rumah::latest()->paginate(5);

        // Return collection of rumahs as a resource
        return new RumahResource(true, 'List of Rumah', $rumahs);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
            'name' => 'required',
            'description' => 'required',
            'price_range' => 'required',
            'location' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload image
        $image = $request->file('image');
        $image->storeAs('public/rumahs', $image->hashName());

        // Create rumah
        $rumah = Rumah::create([
            'image' => $image->hashName(),
            'name' => $request->name,
            'description' => $request->description,
            'price_range' => $request->price_range,
            'location' => $request->location,
        ]);

        // Return response
        return new RumahResource(true, 'Rumah berhasil ditambahkan!', $rumah);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        // Find rumah by ID
        $rumah = Rumah::find($id);

        // Return single rumah as a resource
        return new RumahResource(true, 'Detail Rumah!', $rumah);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price_range' => 'required',
            'location' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find rumah by ID
        $rumah = Rumah::find($id);

        // Check if image is not empty
        if ($request->hasFile('image')) {

            // Upload new image
            $image = $request->file('image');
            $image->storeAs('public/rumahs', $image->hashName());

            // Delete old image
            Storage::delete('public/rumahs/' . basename($rumah->image));

            // Update rumah with new image
            $rumah->update([
                'image' => $image->hashName(),
                'name' => $request->name,
                'description' => $request->description,
                'price_range' => $request->price_range,
                'location' => $request->location,
            ]);
        } else {

            // Update rumah without image
            $rumah->update([
                'name' => $request->name,
                'description' => $request->description,
                'price_range' => $request->price_range,
                'location' => $request->location,
            ]);
        }

        // Return response
        return new RumahResource(true, 'Rumah berhasil diperbarui!', $rumah);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // Find rumah by ID
        $rumah = Rumah::find($id);

        // Delete image
        Storage::delete('public/rumahs/' . basename($rumah->image));

        // Delete rumah
        $rumah->delete();

        // Return response
        return new RumahResource(true, 'Rumah berhasil dihapus!', null);
    }
}
