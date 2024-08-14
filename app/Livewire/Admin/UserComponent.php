<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    
    public function assignRole(User $user, $value) {

        // dump($value);
        if($value == '1'){
            if($user->hasRole('costumer')){
                $user->removeRole('costumer');
            }
            $user->assignRole('admin');
        }else{
            if($user->hasRole('admin')){
                $user->removeRole('admin');    
            }
            $user->assignRole('costumer');
        }
    }

    // public function destroy(User $user) {
    //     if($user->profile_photo_path) {
    //         Storage::delete($user->profile_photo_path);
    //     }

    //     $user->delete(); 

    //     session()->flash('swal', [
    //         'icon'=>'success',
    //         'title'=>'¡Correcto!',
    //         'text'=>'Usuario eliminado exitosamente'
    //     ]);
    //     return redirect()->route('admin.users.index');
    // }

    public function render()
    {
        $users = User::where('email', '<>', auth()->user()->email)  //no se muestra en la tabla el usuario actual
            ->where(function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
                $query->orWhere('email', 'like', '%'.$this->search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.admin.user-component', compact('users'))->layout('layouts.admin');
    }
}
