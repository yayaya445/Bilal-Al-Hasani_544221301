<?php
  
namespace App\Http\Controllers;
  
use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
  
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return response()
     */
    public function index(): View
    {
        $produks = Produk::latest()->paginate(5);
        
        return view('produks.index',compact('produks'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('produks.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'harga_jual' => 'required',
        ]);
    
        $input = $request->all();
      
        Produk::create($input);
       
        return redirect()->route('produks.index')
                        ->with('success','Product created successfully.');
    }
  
    /**
     * Display the specified resource.
     */
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk): View
    {
        return view('produks.edit',compact('produk'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk): RedirectResponse
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'harga_jual' => 'required'
        ]);
    
        $input = $request->all();
    
        $produk->update($input);
      
        return redirect()->route('produks.index')
                        ->with('success','Product has been updated successfully.');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk): RedirectResponse
    {
        $produk->delete();
         
        return redirect()->route('produks.index')
                        ->with('success','Product has been deleted successfully.');
    }
}