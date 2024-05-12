<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataSiswaController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Data Siswa';
        $data['breadcumb'] = 'Data Siswa';
        $data['users'] = User::orderby('id', 'asc')->where('tipe','Siswa')->get();

        return view('data-siswa.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Add Data Siswa';
        $data['breadcumb'] = 'Add Data Siswa';
        $data['roles'] = Role::pluck('name')->all();

        return view('data-siswa.create', $data);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|unique:users,username|alpha_dash',
            'no_tlp'   => 'nullable',
            'password' => 'required|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'role' => 'required',
            'nis' => 'required',
            'lokasi_prakerin' => 'required',
        ]);

        $user = new User();
        $user->name = $validateData['name'];
        $user->username = $validateData['username'];
        $user->no_tlp = $validateData['no_tlp'];
        $user->tipe = $validateData['role'];
        $user->nis = $validateData['nis'];
        $user->lokasi_prakerin = $validateData['lokasi_prakerin'];
       
        $user->password = Hash::make($validateData['password']);

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/users/');
            $image->move($destinationPath, $name);
            $user->avatar = $name;
        }

        $user->save();
        $user->assignRole($validateData['role']);

        return redirect()->route('siswa')->with(['success' => 'Data Siswa added successfully!']);
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Data Siswa';
        $data['breadcumb'] = 'Edit Data Siswa';
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::pluck('name')->all();

        return view('data-siswa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|alpha_dash|unique:users,username,'.$id,
            'no_tlp'   => 'nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'role' => 'required',
            'nis' => 'required',
            'lokasi_prakerin' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validateData['name'];
        $user->username = $validateData['username'];
        $user->no_tlp = $validateData['no_tlp'];
        $user->tipe = $validateData['role'];
        $user->nis = $validateData['nis'];
        $user->lokasi_prakerin   = $validateData['lokasi_prakerin '];
      

         if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/users/');
            $image->move($destinationPath, $name);
            $user->avatar = $name;
        }

        $user->save();
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($validateData['role']);

        return redirect()->route('siswa')->with(['success' => 'Data Siswa edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);
            $user->delete();
        });
        
        return redirect()->route('siswa')->with(['success' => ' successfully!']);
    }

    public function changePassword(Request $request)
    {
        $validateData = $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if (Hash::check($validateData['password'], $user->password)) {
            $user->password = Hash::make($request->get('new_password'));
            $user->save();
    
            return redirect()->route('siswa', Auth::user()->id)->with('success', 'Password changed successfully!');
        } else {
            return redirect()->route('siswa', Auth::user()->id)->with('failed', 'Password change failed');
        }
    }
}
