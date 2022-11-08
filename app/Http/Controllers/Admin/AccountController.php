<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Comment;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $comments = Comment::where('user_id', Auth::user()->id)->get();
            
            return view('account.index', ['comments' => $comments]);
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour voir cette page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, $id)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();
 
            if(isset($request->file_path)) {
                 $imageName = Str::uuid() . '.' . $request->file_path->extension();
                 $request->file_path->move(public_path('images/profile/'), $imageName);
                 $validatedData['file_path'] = $imageName;
 
                 $users = User::where('id', $id)->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'file_path' => $validatedData['file_path'],
                 ]);
             }

            else {
                $users = User::where('id', $id)->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                ]);
            };

             return redirect('/account')->with('success', 'Modifications effectuées');
         }
 
         return redirect('/')->with('error', 'Vous devez être connecté pour modifier un article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
