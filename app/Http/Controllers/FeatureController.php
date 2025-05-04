<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class FeatureController extends Controller
// {
//     //
// }

// namespace App\Http\Controllers;

// use App\Models\Feature;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class FeatureController extends Controller
// {
//     public function index()
//     {
//         $features = Feature::all();
//         return view('admin.features.index', compact('features'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'title' => 'required|string|max:255',
//             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         ]);

//         $imagePath = $request->file('image')->store('public/images');

//         Feature::create([
//             'title' => $request->title,
//             'image' => $imagePath,
//         ]);

//         return redirect()->route('features.index');
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'title' => 'required|string|max:255',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         ]);

//         $feature = Feature::findOrFail($id);
//         $feature->title = $request->title;

//         if ($request->hasFile('image')) {
//             $imagePath = $request->file('image')->store('public/images');
//             Storage::delete($feature->image);
//             $feature->image = $imagePath;
//         }

//         $feature->save();

//         return redirect()->route('features.index');
//     }

//     public function destroy($id)
//     {
//         $feature = Feature::findOrFail($id);
//         Storage::delete($feature->image);
//         $feature->delete();

//         return redirect()->route('features.index');
//     }
// }




namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::all();
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.index'); // Reuse index for modal
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Feature::create([
            'title' => $request->title,
            'image' => $imageName,
        ]);

        return redirect()->route('features.index')->with('success', 'Feature created successfully.');
    }

    public function show(Feature $feature)
    {
        return view('admin.features.index', compact('feature'));
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.index', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = ['title' => $request->title];

        if ($request->hasFile('image')) {
            if (File::exists(public_path('images/' . $feature->image))) {
                File::delete(public_path('images/' . $feature->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $feature->update($data);

        return redirect()->route('features.index')->with('success', 'Feature updated successfully.');
    }

    public function destroy(Feature $feature)
    {
        if (File::exists(public_path('images/' . $feature->image))) {
            File::delete(public_path('images/' . $feature->image));
        }
        $feature->delete();
        return redirect()->route('features.index')->with('success', 'Feature deleted successfully.');
    }
}