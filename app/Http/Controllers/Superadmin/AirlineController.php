<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AirlineController extends Controller
{
    public function index()
    {
        $airlines= Airline::all();
        return view('superadmin.airline.index', compact('airlines'));
    }

    public function create()
    {
        return view('superadmin.airline.create');
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|unique:airlines,logo',
            'airline' => 'required|unique:airlines,airline',
            'total_seats' => 'required|integer',
        ], [
            'airline.unique' => 'The airline has already been added. Please input another airline.',
        ]);

        $airlines = new Airline();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/upload/airline/', $filename);
            $airlines->logo = $filename;
        }

        $airlines->airline = $request->input('airline');
        $airlines->total_seats = $request->input('total_seats');
        $airlines->save();
        return redirect('superadmin/airline-lists')->with('success', 'Airline Added Successfully');
    }
 
    public function edit($id)
    {
        $airlines = Airline::find($id);
        return view('superadmin.airline.edit', compact('airlines'));
    }

    public function update(Request $request, $id)
    {
        $airlines = Airline::find($id);
        if ($request->hasFile('logo')) {
            $path = 'assets/upload/airline/' .$airlines->logo;
            if (File::exists($path))
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/upload/airline/', $filename);
            $airlines->logo = $filename;
        }

        $airlines->airline = $request->input('airline');
        $airlines->total_seats = $request->input('total_seats');
        $airlines->update();
        return redirect('superadmin/airline-lists')->with('success', 'Airline Updated Successfully');
    }
}
