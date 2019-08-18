<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Advertisement;
use App\Product;
use App\Items;
use App\Category;
use Illuminate\Support\Facades\DB;

class profileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $profile = User::where('id', '=', auth()->id())->first();
        $adds = Advertisement::join('products', 'products.id', '=', 'advertisements.product_id')
            ->where('user_id', '=', auth()->id())->get();
        $currentMonth = date('m');
        $count = 0;
        // foreach ($adds as $key) {
        //     $mydate = $key . created_at;
        //     $month = date("m", strtotime($mydate));
        //     if ($currentMonth == $month) {
        //         $count++;
        //     }
        // }
        return view('userDashboard', ['profile_full' => $profile, 'adds' => $adds, 'count' => $count]);
    }

    public function edit(Request $request)
    {
        $id = auth()->id();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'mobile_no' => 'required'
        ]);

        $user = User::find($id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->date_of_birth = $request->get('date_of_birth');
        $user->address = $request->get('address');
        $user->mobile_no = $request->get('mobile_no');
        if ($request->get('personal_bkash_no')) {
            $user->personal_bkash_no = $request->get('personal_bkash_no');
        }
        if ($request->get('paypal_account_no')) {
            $user->paypal_account_no = $request->get('paypal_account_no');
        }
        
        $user->save();

        return redirect('/userDashboard');
    }

    public function activity()
    {
        $ads = Advertisement::join('products', 'products.id', '=', 'advertisements.product_id')
                ->where('user_id', '=', auth()->id())->get();
        
        $sold = Advertisement::where('isSold', '=', 1)->where('user_id', '=', auth()->id())->get();

        return view('activity', ['ads' => $ads, 'totalSells' => $sold]);
    }

    public function editAd($id)
    {
        $adDetails = DB::table('advertisements')
            ->join('products', 'advertisements.product_id', '=', 'products.id')
            ->select('advertisements.*','advertisements.id as advertisement_id', 'products.*')
            ->where('advertisements.product_id', $id)
            ->get();

        return view('editAd', ['advertisements' => $adDetails, 'categories' => Category::all()]);
    }

    public function deleteAd($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect('/userDashboard/activities');
    }

    public function markSold($id)
    {
        $ad = Advertisement::find($id);

        $ad->isSold = 1;
        $ad->save();

        return redirect('/userDashboard/activities');
    }

    public function updateProduct(Request $request, $id, $pid)
    {
        $product = Product::find($pid);
        print_r($id);
        print_r($pid);
        $advertisement = Advertisement::find($id);

        $product->name = $request->get('name');
        $product->brand = $request->get('brand');
        $product->category_id = $request->get('category_id');
        $product->condition = $request->get('condition');
        if($request->get('buying_year'))
        {
            $product->buying_year = $request->get('buying_year');
        }
        $product->specification = $request->get('specification');
        $advertisement->proposed_price = $request->get('proposed_price');
        if($request->get('color'))
        {
            $product->color = $request->get('color');
        }
        if($request->get('weight'))
        {
            $product->weight = $request->get('weight');
        }
        if($request->get('size'))
        {
            $product->size = $request->get('size');
        }
        if($request->get('guarantee'))
        {
            $product->guarantee = $request->get('guarantee');
        }
        if($request->get('warranty'))
        {
            $product->warranty = $request->get('warranty');
        }
        if($request->hasFile('display_image'))
        {
            $file = $request->file('display_image');
            $fileNameWithExt = $request->file('display_image')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
            $product->display_image = $fileNameWithExt;
        }

        if($request->hasFile('img1'))
        {
            $file = $request->file('img1');
            $fileNameWithExt = $request->file('img1')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
            $product->img1 = $fileNameWithExt;
        }
        if($request->hasFile('img2'))
        {
            $file = $request->file('img2');
            $fileNameWithExt = $request->file('img2')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
            $product->img2 = $fileNameWithExt;
        }
        if($request->hasFile('img3'))
        {
            $file = $request->file('img3');
            $fileNameWithExt = $request->file('img3')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
            $product->img3 = $fileNameWithExt;
        }

        if($request->hasFile('img4'))
        {
            $file = $request->file('img4');
            $fileNameWithExt = $request->file('img4')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
            $product->img4 = $fileNameWithExt;
        }

        $product->save();
        $advertisement->save();

        return redirect("/userDashboard/activities");
    }

    public function deleteDisplayImage($id)
    {
        $product = Product::find($id);

        $product->display_image = "";
        $product->save();

        return redirect("/editAd/$id");
    }

    public function deleteImg1($id)
    {
        $product = Product::find($id);

        $product->img1 = null;
        $product->save();

        return redirect("/editAd/$id");
    }

    public function deleteImg2($id)
    {
        $product = Product::find($id);

        $product->img2 = null;
        $product->save();

        return redirect("/editAd/$id");
    }

    public function deleteImg3($id)
    {
        $product = Product::find($id);

        $product->img3 = null;
        $product->save();

        return redirect("/editAd/$id");
    }

    public function deleteImg4($id)
    {
        $product = Product::find($id);

        $product->img4 = null;
        $product->save();

        return redirect("/editAd/$id");
    }
}
