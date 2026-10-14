<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        // The part of the URL => the name we show
        $categories = [
            'appetizers' => 'Appetizers',
            'main-dishes' => 'Main dishes',
            'desserts' => 'Desserts',
        ];

        return view('home', [
            'categories' => $categories,
        ]);
    }

    public function about()
    {
        $school = 'Hogeschool Rotterdam';

        return view('about', [
            'school' => $school,
        ]);
    }

    public function contact()
    {
        return view('contact');
    }
}
