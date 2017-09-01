<?php
/**
 * Created by PhpStorm.
 * User: liudian
 * Date: 8/31/17
 * Time: 09:56
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function home(Request $request)
    {
        return view('admin.home');
    }

    public function agentList()
    {
        return view('admin.agent.list');
    }
}