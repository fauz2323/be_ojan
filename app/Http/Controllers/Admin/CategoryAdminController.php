<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WisataCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CategoryAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //ajax request datatables
        if ($request->ajax()) {
            $data = WisataCategory::with('admin')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.category.edit', Crypt::encrypt($row->id)) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Edit</a>';
                    $btn = $btn . ' <a href="' . route('admin.category.delete', Crypt::encrypt($row->id)) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory">Delete</a>';
                    return $btn;
                })
                ->addColumn('date', function ($row) {
                    $date = date('d M Y', strtotime($row->created_at));
                    return $date;
                })
                ->rawColumns(['action', 'date'])
                ->make(true);
        }
        return view('admin.category.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $category = new WisataCategory;
        $category->category = $request->category;
        $category->user_id = auth()->user()->id;
        $category->save();

        return back()->with('success', 'Category saved successfully');
    }

    public function edit($id)
    {
        $category = WisataCategory::find(Crypt::decrypt($id));
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $category = WisataCategory::find(Crypt::decrypt($id));
        $category->update([
            'category' => $request->category,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = WisataCategory::find(Crypt::decrypt($id));
        $category->delete();
        return back()->with('success', 'Category deleted successfully');
    }
}
