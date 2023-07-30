<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\WisataCategory;
use App\Models\WisataImage;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class WisataAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        //request ajax datatable
        if ($request->ajax()) {
            $data = Wisata::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editWisata">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteWisata">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.wisata.index');
    }

    public function add()
    {
        $category = WisataCategory::all();
        return view('admin.wisata.add', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'wisata_category_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'opening_hours' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $wisata = new Wisata();
        $wisata->wisata_category_id = $request->wisata_category_id;
        $wisata->nama = $request->nama;
        $wisata->alamat = $request->alamat;
        $wisata->deskripsi = $request->deskripsi;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->opening_hours = $request->opening_hours;
        $wisata->save();

        foreach ($request->file('image') as $key) {
            $name = Uuid::uuid4() . '.' . $key->getClientOriginalExtension();
            //store image
            $key->move(public_path('storage/image'), $name);

            $image = new WisataImage();
            $image->wisata_id = $wisata->id;
            $image->image = $key->store('wisata');
            $image->save();
        }

        return redirect()->back()->with('success', 'Wisata berhasil ditambahkan');
    }

    public function edit($id)
    {
        $wisata = Wisata::find($id);
        return response()->json($wisata);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'wisata_category_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'opening_hours' => 'required',
        ]);

        $wisata = Wisata::find($id);
        $wisata->wisata_category_id = $request->wisata_category_id;
        $wisata->nama = $request->nama;
        $wisata->alamat = $request->alamat;
        $wisata->deskripsi = $request->deskripsi;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->opening_hours = $request->opening_hours;
        $wisata->save();

        if ($request->file('image')) {
            foreach ($request->file('image') as $key) {
                $name = Uuid::uuid4() . '.' . $key->getClientOriginalExtension();
                //store image
                $key->move(public_path('storage/image'), $name);

                $image = new WisataImage();
                $image->wisata_id = $wisata->id;
                $image->image = $key->store('wisata');
                $image->save();
            }
        }

        return redirect()->back()->with('success', 'Wisata berhasil diupdate');
    }

    public function destroy($id)
    {
        $wisata = Wisata::find($id);
        $wisata->delete();

        return redirect()->back()->with('success', 'Wisata berhasil dihapus');
    }
}
