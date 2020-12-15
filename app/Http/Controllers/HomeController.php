<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featuredProducts = Product::where('featured', TRUE)
                            ->where('quantity', '>', 0)
                            ->inRandomOrder()
                            ->take(8)
                            ->get();

        $newProducts = Product::whereRaw("DATEDIFF(CURDATE(), created_at) <= ". Product::NEW_PRODUCT_DURATION)
                            ->inRandomOrder()
                            ->take(3)
                            ->get();

        return view('home', compact(['featuredProducts', 'newProducts']));
    }
}
