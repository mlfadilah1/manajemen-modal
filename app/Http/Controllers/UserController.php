<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'Staff')
            ->orderBy('id', 'DESC')
            ->get();

        
        return view('admin.user.index', compact('users'));
    }
    function deleteuser($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect('/user')->with('success', 'Data user berhasil dihapus.');
    }
    public function tambah()
    {
        $data = array(
            'users' => DB::table('users')
                ->get(),
        );
        return view('admin.user.tambah', $data);
    }
    public function submituser(Request $request)
    {
        $name            = $request->name;
        $email            = $request->email;
        $password         = $request->password;

        // if ($request->hasFile('foto')) {
        //     $foto       = $name . "." . $request->file('foto')->getClientOriginalExtension();
        // } else {
        //     $foto       = null;
        // }

        try {
            $data = [
                'name'           => $name,
                'email'          => $email,
                'role'          => 'Staff',
                // 'foto'           => $foto,
                'password'       => bcrypt($password),
            ];
            $simpan     = DB::table('users')->insert($data);
            if ($simpan) {
                // if ($request->hasFile('foto')) {
                //     $folderPath = "public/users";
                //     $request->file('foto')->storeAs($folderPath, $foto);
                // }
                return redirect('/user')->with('success', 'Data User berhasil di tambahkan.');
            }
        } catch (\Exception $e) {
            return redirect('/tambahuser')->with('error', 'Data User gagal di tambahkan.');
        }
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edituser', compact('user'));
    }

    // Mengupdate data user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'nullable|min:6'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'Staff';

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }
}
