<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class NotificationAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //ajax request datatables
        if ($request->ajax()) {
            $data = Notification::with('user')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.notification.edit', Crypt::encrypt($row->id)) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary m-1 btn-sm editNotification">Edit</a>';
                    $btn = $btn . ' <a href="' . route('admin.notification.delete', Crypt::encrypt($row->id)) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger m-1 btn-sm deleteNotification">Delete</a>';
                    $btn = $btn . ' <a href="' . route('admin.notification.publish', Crypt::encrypt($row->id)) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="btn btn-success m-1 btn-sm viewNotification">publish</a>';

                    return $btn;
                })
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->rawColumns(['action', 'date'])
                ->make(true);
        }
        return view('admin.notification.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $notification = new Notification;
        $notification->user_id = Auth::user()->id;
        $notification->title = $request->title;
        $notification->description = $request->description;
        if ($request->file('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $notification->image = $imageName;
        }
        $notification->status = 'not-publish';
        $notification->save();

        return redirect()->back()->with('success', 'Notification created successfully.');
    }

    public function edit($id)
    {
        //
        $notification = Notification::find(Crypt::decrypt($id));
        return view('admin.notification.edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $notification = Notification::find($id);
        $notification->title = $request->title;
        $notification->description = $request->description;
        $notification->status = $request->status;
        if ($request->file('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $notification->image = $imageName;
        }
        $notification->save();

        return redirect()->route('admin.notification.index')->with('success', 'Notification updated successfully.');
    }

    public function destroy($id)
    {
        $notification = Notification::find(Crypt::decrypt($id));
        $notification->delete();
        return redirect()->route('admin.notification.index')->with('success', 'Notification deleted successfully.');
    }

    public function publish($id)
    {
        $notification = Notification::find(Crypt::decrypt($id));
        if ($notification->status == 'publish') {
            $notification->status = 'non-publish';
            $notification->save();
        } else {
            $notification->status = 'publish';
            $notification->save();
        }


        return redirect()->route('admin.notification.index')->with('success', 'Notification publish successfully.');
    }
}
