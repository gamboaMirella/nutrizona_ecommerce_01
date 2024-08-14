<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index() {
        $users=User::where('name', 'like', '%'.request('search').'%')->orderBy('id', 'desc')->paginate(10);
        // dump($users);
        return view('admin.users.index', compact('users'));    
    }

    public function edit(User $user) {

        return view('admin.users.edit', compact('user'));
    }

    public function update() {
        
    }

    public function destroy(User $user) {
        if($user->profile_photo_path) {
            Storage::delete($user->profile_photo_path);
        }

        $user->delete(); 

        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'¡Correcto!',
            'text'=>'Usuario eliminado exitosamente'
        ]);
        return redirect()->route('admin.users.index');
    }
    
}
