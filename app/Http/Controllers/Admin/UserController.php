<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebinarQuestion;
use App\Models\WebinarRegistration;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = WebinarRegistration::with('questions')->orderBy('id', 'desc')->get();

        return view('admin.users.index', compact('data'));
    }
    public function show($uid)
    {
        $data = WebinarRegistration::with('questions')->where('unique_id',$uid)->first();

        // dd($data);
        return view('admin.users.show', compact('data'));
    }
    public function userQuestoins()
    {
        $data = WebinarQuestion::with('registration')->orderBy('id', 'desc')->get();
        return view('admin.user_questions.index', compact('data'));
    }
}
