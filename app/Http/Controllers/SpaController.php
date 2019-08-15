<?php

namespace App\Http\Controllers;

class SpaController
{
    /**
     * SPA entry point
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('spa');
    }
}
