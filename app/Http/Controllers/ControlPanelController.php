<?php

namespace App\Http\Controllers;

class ControlPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('control-panel.index');
    }
}
