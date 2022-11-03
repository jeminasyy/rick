<?php

namespace App\Http\Controllers;

use App\Models\Categ;
use Illuminate\Http\Request;

class CategController extends Controller
{
    // Show categories list
    public function index() {
        // Make sure user is an admin
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        return view('admin.categories.index', [
            'heading' => 'Categories',
            'categs' => Categ::latest()->filter(request(['search']))->paginate(5)
        ]);
    }

    // Show create form
    public function create() {
        // Make sure user is an admin
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        return view('admin.categories.create');
    }

    // Store New Category Data
    public function store(Request $request) {
        // Make sure user is an admin
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }
        
        // dd($request->description);
        $formFields = $request->validate([
            'name' => ['required', 'min:2'],
            'type' => ['required'],
        ]);

        if($request->description) {
            $formFields['description'] = $request->description;
        }

        Categ::create($formFields);

        return redirect('/categories')->with('message', 'Category created successfully');
    }
}
