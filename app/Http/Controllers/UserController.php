<?php
  
namespace App\Http\Controllers;
  
use App\Models\User;
use Illuminate\Http\Request;
  
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(2);
    
        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 2);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                        
        $request->validate([
            'username' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'date_of_birth' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required',
            'password' => [
                'required',
                'min:8'
            ],
        ]);

        $data = $request->all();
        if($file = $request->hasFile('image')){
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/image' ;
            $file->move($destinationPath,$fileName);
            $data['image'] = $fileName;
        }
        User::create($data);
        return redirect()->route('users.index')
                        ->with('success','user created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'date_of_birth' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required',
        ]);
  
        $data = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }else{
            unset($data['image']);
        }
          
        $user->update($data);
    
        return redirect()->route('users.index')
                        ->with('success','user updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
     
        return redirect()->route('users.index')
                        ->with('success','user deleted successfully');
    }
}