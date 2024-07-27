// app/Http/Controllers/Auth/UpdatePasswordController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdatePasswordController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form to update the user's password.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('auth.update-password');
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The provided current password is incorrect.']);
        }

        auth()->user()->updatePassword($request->new_password);

        return redirect()->route('home')->with('success', 'Password updated successfully!');
    }
}
