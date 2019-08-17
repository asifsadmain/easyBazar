<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{
    //for create controller - php artisan make:controller AutocompleteController

    function index()
    {
        return view('autocomplete');
    }

    function fetch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('products')
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('brand', 'LIKE', "%{$query}%")
                ->distinct()->get('name');
            $output = '<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="display:block; max-height:500%; overflow:scroll; left: 35%; top: 70%;">';
            foreach($data as $row)
            {
                $output .= '
                <li class="dropdown-item"><a class="text-secondary nav-link" href="/advertisements/search/'.$row->name.'">'.$row->name.'</a></li>
                ';
            }
            $output .= '</div>';
            echo $output;
        }
    }
}