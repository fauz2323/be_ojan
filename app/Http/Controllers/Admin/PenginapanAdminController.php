<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penginapan;
use App\Models\PenginapanImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class PenginapanAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        //request ajax datatable
        if ($request->ajax()) {
            $data = Penginapan::with('admin')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('admin.penginapan.edit', Crypt::encrypt($row->id)) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editpenginapan m-1">Edit</a>';

                    $btn = $btn . ' <a href="' . route('admin.penginapan.delete', Crypt::encrypt($row->id)) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletepenginapan m-1">Delete</a>';

                    return $btn;
                })
                ->addColumn('date', function ($row) {
                    return $row->created_at->format('d-m-Y');
                })
                ->rawColumns(['action', 'date'])
                ->make(true);
        }
        return view('admin.penginapan.index');
    }

    public function add()
    {
        return view('admin.penginapan.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'fitur' => 'required',
            'deskripsi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'operating_hours' => 'required',
            'image' => 'required',
            'telp' => 'required',
        ]);

        $penginapan = new Penginapan();
        $penginapan->user_id = Auth::user()->id;
        $penginapan->nama = $request->nama;
        $penginapan->alamat = $request->alamat;
        $penginapan->fitur = $request->fitur;
        $penginapan->deskripsi = $request->deskripsi;
        $penginapan->latitude = $request->latitude;
        $penginapan->longitude = $request->longitude;
        $penginapan->operating_hours = $request->operating_hours;
        $penginapan->telp = $request->telp;
        $penginapan->save();

        foreach ($request->file('image') as $key) {
            $name = Uuid::uuid4() . '.' . $key->getClientOriginalExtension();
            //store image
            $key->move(public_path('storage/image'), $name);

            $image = new PenginapanImage();
            $image->penginapan_id = $penginapan->id;
            $image->image = $name;
            $image->uuid = Uuid::uuid4();
            $image->save();
        }

        return redirect()->route('admin.penginapan.index')->with('success', 'Penginapan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penginapan = Penginapan::find(Crypt::decrypt($id));

        return view('admin.penginapan.edit', compact('penginapan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'fitur' => 'required',
            'deskripsi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'operating_hours' => 'required',
            'telp' => 'required',
        ]);

        $penginapan = Penginapan::find($id);
        $penginapan->user_id = Auth::user()->id;
        $penginapan->nama = $request->nama;
        $penginapan->alamat = $request->alamat;
        $penginapan->fitur = $request->fitur;
        $penginapan->deskripsi = $request->deskripsi;
        $penginapan->latitude = $request->latitude;
        $penginapan->longitude = $request->longitude;
        $penginapan->operating_hours = $request->operating_hours;
        $penginapan->telp = $request->telp;
        $penginapan->save();

        if ($request->file('image')) {
            foreach ($request->file('image') as $key) {
                $name = Uuid::uuid4() . '.' . $key->getClientOriginalExtension();
                //store image
                $key->move(public_path('storage/image'), $name);

                $image = new PenginapanImage();
                $image->penginapan_id = $penginapan->id;
                $image->image = $key->store('penginapan');
                $image->save();
            }
        }

        return redirect()->route('admin.penginapan.index')->with('success', 'penginapan berhasil diupdate');
    }

    public function destroy($id)
    {
        $penginapan = Penginapan::find(Crypt::decrypt($id));
        $image = PenginapanImage::where('penginapan_id', $penginapan->id)->get();
        foreach ($image as $key) {
            $key->delete();
        }

        $penginapan->delete();

        return redirect()->back()->with('success', 'penginapan berhasil dihapus');
    }
}
