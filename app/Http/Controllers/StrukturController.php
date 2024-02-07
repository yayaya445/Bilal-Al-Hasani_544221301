<?php
  
namespace App\Http\Controllers;
  
use App\Models\Struktur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
  
class StrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return response()
     */
    public function index(): View
    {
        $strukturs = Struktur::latest()->paginate(5);
        
        return view('strukturs.index',compact('strukturs'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('strukturs.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required',
            'divisi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'latarbelakang' => 'required',
        ]);
    
        $input = $request->all();
    
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
      
        Struktur::create($input);
       
        return redirect()->route('strukturs.index')
                        ->with('success','Product created successfully.');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(Struktur $struktur): View
    {
        return view('strukturs.show',compact('struktur'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Struktur $struktur): View
    {
        return view('strukturs.edit',compact('struktur'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Struktur $struktur): RedirectResponse
    {
        $request->validate([
            'nama' => 'required',
            'divisi' => 'required',
            'latarbelakang' => 'required',
        ]);
    
        $input = $request->all();
    
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
            
        $struktur->update($input);
      
        return redirect()->route('strukturs.index')
                        ->with('success','Product has been updated successfully.');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Struktur $struktur): RedirectResponse
    {
        $struktur->delete();
         
        return redirect()->route('strukturs.index')
                        ->with('success','Product has been deleted successfully.');
    }
}