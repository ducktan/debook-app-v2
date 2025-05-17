<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;




use Illuminate\Http\Request;

class AdminController extends Controller
{
    //// User
    public function index()
    {
        return view('pages.admin.dashboard');
    }
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('pages.admin.userSetting', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'utype' => 'required|in:ADM,USR,VIP',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'utype' => $request->utype,
        ]);

        return response()->json(['message' => 'Người dùng đã được thêm thành công!']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Xoá người dùng thành công.']);
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'full_name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        //     'phone' => 'nullable|string|max:20',
        //     'utype' => 'required|in:adm,usr,VIP',
        //     'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
      
     

        $user->name = $request->name;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->utype = $request->utype;

        if ($request->hasFile('avatar')) {
            if ($user->avatar && file_exists(public_path('assets/img/avatars/' . $user->avatar))) {
                unlink(public_path('assets/img/avatars/' . $user->avatar));
            }

            $avatarName = time() . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->move(public_path('assets/img/avatars'), $avatarName);
            $user->avatar = $avatarName;
        }

        $user->save();

        return redirect()->route('admin.users.show')->with('success', 'Cập nhật thông tin người dùng thành công!');
    }


}
