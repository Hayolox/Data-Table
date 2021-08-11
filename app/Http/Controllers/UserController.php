<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
class UserController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $users = User::query();
            return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                    $url_edit = url(''.$data->id);
                    $url_hapus = url('delete/'.$data->id); 
                    $button = '<a href="'.$url_edit.'" class="btn btn-primary">Edit</a>';
                    $button .= '<a href="'.$url_hapus.'" class="btn btn-danger" class="mr-5">Hapus</a>';
                    return $button;
            })
            ->rawColumns(['action'])
            ->make();
        }
        return view('welcome');
    }
    
    public function delete($id)
    {
        $data = User::findorFail($id);
        $data->delete();
        return back();
    }
}
