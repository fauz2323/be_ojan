<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\WisataCategory;
use App\Models\WisataClick;
use App\Models\WisataImage;
use App\Models\WisataInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
            $data = Wisata::with('admin', 'kategori')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('admin.wisata.edit', Crypt::encrypt($row->id)) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editWisata m-1">Edit</a>';

                    $btn = $btn . ' <a href="' . route('admin.wisata.delete', Crypt::encrypt($row->id)) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteWisata m-1">Delete</a>';

                    return $btn;
                })
                ->addColumn('date', function ($row) {
                    return $row->created_at->format('d-m-Y');
                })
                ->rawColumns(['action', 'date'])
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
            'operating_hours' => 'required',
            'image' => 'required',

        ]);

        $wisata = new Wisata();
        $wisata->wisata_category_id = $request->wisata_category_id;
        $wisata->user_id = Auth::user()->id;
        $wisata->nama = $request->nama;
        $wisata->alamat = $request->alamat;
        $wisata->deskripsi = $request->deskripsi;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->operating_hours = $request->operating_hours;
        $wisata->save();

        $info = new WisataInfo();
        $info->wisata_id = $wisata->id;
        $info->phone = $request->telp ?? '-';
        $info->email = $request->email ?? '-';
        $info->website = $request->web ?? '-';
        $info->save();

        $click = new WisataClick();
        $click->wisata_id = $wisata->id;
        $click->user_click = 0;
        $click->save();

        foreach ($request->file('image') as $key) {
            $name = Uuid::uuid4() . '.' . $key->getClientOriginalExtension();
            //store image
            $key->move(public_path('storage/image'), $name);

            $image = new WisataImage();
            $image->wisata_id = $wisata->id;
            $image->image = $name;
            $image->uuid = Uuid::uuid4();
            $image->save();
        }

        return redirect()->route('admin.wisata.index')->with('success', 'Wisata berhasil ditambahkan');
    }

    public function edit($id)
    {
        $wisata = Wisata::find(Crypt::decrypt($id));
        $category = WisataCategory::all();

        return view('admin.wisata.edit', compact('wisata', 'category'));
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

        $wisata = new Wisata();
        $wisata->wisata_category_id = $request->wisata_category_id;
        $wisata->user_id = Auth::user()->id;
        $wisata->nama = $request->nama;
        $wisata->alamat = $request->alamat;
        $wisata->deskripsi = $request->deskripsi;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->operating_hours = $request->operating_hours;
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
        $wisata = Wisata::find(Crypt::decrypt($id));
        $image = WisataImage::where('wisata_id', $wisata->id)->get();
        foreach ($image as $key) {
            $key->delete();
        }
        $wisata->info()->delete();
        $wisata->delete();

        return redirect()->back()->with('success', 'Wisata berhasil dihapus');
    }
}
