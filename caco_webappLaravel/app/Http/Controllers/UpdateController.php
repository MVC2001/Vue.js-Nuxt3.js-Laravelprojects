// app/Http/Controllers/UpdateController.php

namespace App\Http\Controllers;

use App\Models\Update;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function index()
    {
        $updates = Update::all();
        return view('updates.index', compact('updates'));
    }

    public function create()
    {
        return view('updates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'comment' => 'required',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Update::create([
            'image' => $imageName,
            'comment' => $request->comment,
        ]);

        return redirect()->route('updates.index')->with('success','Update created successfully.');
    }

    public function edit($id)
    {
        $update = Update::find($id);
        return view('updates.edit', compact('update'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $update = Update::find($id);
        $update->comment = $request->comment;
        $update->save();

        return redirect()->route('updates.index')->with('success','Update updated successfully.');
    }

    public function destroy($id)
    {
        Update::destroy($id);
        return redirect()->route('updates.index')->with('success','Update deleted successfully.');
    }
}
