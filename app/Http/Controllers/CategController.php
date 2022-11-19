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
            'categs' => Categ::where('archive', 0)->filter(request(['search']))->paginate(5)
        ]);
    }

    // Show archived categories list
    public function archived() {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        return view('admin.categories.archived', [
            'heading' => 'Categories',
            'categs' => Categ::where('archive', 1)->filter(request(['search']))->paginate(5)
        ]);
    }

    // Archive Category
    public function archive(Categ $categ) {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        $formFields['archive'] = 1;
        $categ->update($formFields);

        return redirect('/categories')->with('message', 'Category archived successfully');
    }

    // Unarchive Category
    public function unarchive(Categ $categ) {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }
        
        $formFields['archive'] = false;
        $categ->update($formFields);

        return redirect('/categories')->with('message', 'Category archived successfully');
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

    // Show edit form
    public function edit(Categ $categ) {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        return view('admin.categories.edit', [
            'categ' => $categ
        ]);
    }

    // Update Category
    public function update(Request $request, Categ $categ) {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        $formFields = $request->validate([
            'name' => ['required', 'min:2'],
            'type' => ['required'],
        ]);

        if($request->description) {
            $formFields['description'] = $request->description;
        }

        $categ->update($formFields);

        return redirect('/categories')->with('message', 'Category updated successfully');
    }
}
