<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebinarQuestion;
use App\Models\WebinarRegistration;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data = WebinarRegistration::all();
        return view('admin.users.index', compact('data'));
    }
    public function userQuestoins(){
        $data = WebinarQuestion::with('registration')->get();
        return view('admin.user_questions.index', compact('data'));
    }
}
