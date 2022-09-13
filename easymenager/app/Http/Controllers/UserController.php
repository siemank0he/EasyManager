<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Hours;
use App\Vacation;
use Image;
use DB;

class UserController extends Controller
{
    public function edit(){
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);

            if ($user) {
            return view('user.edit')->withUser($user);
            } else {

            }
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request){
        $user = User::find(Auth::user()->id);

        if ($user) {
            if (Auth::user()->email === $request['email']){
                $validate = $request->validate([
                    'name' => 'required|min:2',
                    'email' => 'required|email'
                ]);
            } else {
                $validate = $request->validate([
                    'name' => 'required|min:2',
                    'email' => 'required|email|unique:users'
                ]);
            }
            
            if ($validate) {
                $user->name = $request['name'];
                $user->email = $request['email'];

                $user->save();

                $request->session()->flash('success','Dane zostały zaktualizowane');
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function passwordEdit(){
        if (Auth::user()) {
            return view('user.password');
        } else {
            return redirect()->back();
        }
    }

    public function passwordUpdate(Request $request){
        $validate = $request->validate([
            'oldPassword' => 'required|min:7',
            'password' => 'required|min:7|required_with:password_confirmation'
        ]);

        $user = User::find(Auth::user()->id);

        if ($user) {
            if (Hash::check($request['oldPassword'], $user->password) && $validate) {
                $user->password = $request['password'];

                $user->save();

                $request->session()->flash('success','Twoje hasło zostało zmienione.');
                return redirect()->back();
            } else {
                $request->session()->flash('error','Twoje obecne hasło nie zgadza się.');
                return redirect()->route('password.edit');
            }
        }
    }

    public function profile($id){
        $user = User::find($id);

        if ($user) {
            return view('user.profile')->withUser($user);
        } else {
            return redirect()->back();
        }
    }

    public function adminPanelindex()
    {
        if((Auth::user()->is_admin) == 'Administrator'){
            $user = User::all();      
            return view('panel')
            ->with('users', $user);
        } else {
            return redirect()->back();
        }
        
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/panel');
    }

    public function create()
    {
        return view('panel');
    }

    public function vacation()
    {
        return view('vacation');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'zarobki' => 'required'
        ]);
        
        $user = User::create(request(['name', 'email', 'password', 'zarobki']));
        
        return redirect()->to('/panel');
    }

    public function vacation_proposal(Request $request)
    {
        if($request->has('dodaj')){
            $vacation = new Vacation();

            $vacation->od = request('od_kiedy');
            $vacation->do = request('do_kiedy');
            $vacation->notka = request('notka');
            $vacation->ktownioskuje = request('ktownioskuje');
            $vacation->status = request('status', 'Wysłano');
            $vacation->save();
            return redirect()->to('/vacation');
        }
    }

    public function updateVacation($id, Request $request){
        if($request->has('update')){
            $vacation = Vacation::findOrFail($id);
            $updateStatus = 'Akceptowano!';
            $query = DB::table('vacation')->where('id', $id)->update(['status' => $updateStatus]);
            
            return redirect()->to('/vacation');
            
        }
    }

    public function deleteVacation($id){
        $vacation = Vacation::findOrFail($id);
        $vacation->delete();

        return redirect('/vacation');
    }
}
