<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Product;
use App\Advertisement;
use Auth;

class PostAdController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function submit(Request $request){
        if($request->hasFile('display_image'))
        {
            $file = $request->file('display_image');
            $fileNameWithExt = $request->file('display_image')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
        }

        if($request->hasFile('img1'))
        {
            $file = $request->file('img1');
            $fileNameWithExt = $request->file('img1')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
        }
        if($request->hasFile('img2'))
        {
            $file = $request->file('img2');
            $fileNameWithExt = $request->file('img2')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
        }
        if($request->hasFile('img3'))
        {
            $file = $request->file('img3');
            $fileNameWithExt = $request->file('img3')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
        }

        if($request->hasFile('img4'))
        {
            $file = $request->file('img4');
            $fileNameWithExt = $request->file('img4')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
        }

        $product = new Product;
        $advertisement = new Advertisement;
        $product->name = $request->input('name');
        $product->display_image = $request->file('display_image')->getClientOriginalName();
        $product->img1 = "";
        $product->img2 = "";
        $product->img3 = "";
        $product->img4 = "";
        if($request->input('img1'))
        {
            $product->img1 = $request->file('img1');
        }
        if($request->input('img2'))
        {
            $product->img2 = $request->file('img2');
        }
        if($request->input('img3'))
        {
            $product->img3 = $request->file('img3');
        }
        if($request->input('img4'))
        {
            $product->img4 = $request->file('img4');
        }
        $product->brand = $request->input('brand');
        $product->category_id = $request->get('category_id');
        $product->condition = $request->input('condition');
        if($request->input('buying_year'))
        {
            $product->buying_year = $request->input('buying_year');
        }
        $product->specification = $request->input('specification');
        if($request->input('color'))
        {
            $product->color = $request->input('color');
        }
        if($request->input('weight'))
        {
            $product->weight = $request->input('weight');
        }
        if($request->input('size'))
        {
            $product->size = $request->input('size');
        }
        if($request->input('guarantee'))
        {
            $product->guarantee = $request->input('guarantee');
        }
        if($request->input('warranty'))
        {
            $product->warranty = $request->input('warranty');
        }

        $product->save();

        $advertisement->user_id = Auth::user()->id;
        $advertisement->product_id = $product->id;
        $advertisement->proposed_price = $request->input('proposed_price');
        $advertisement->isSold = false;
        //$advertisement->selling_date = null;

        $advertisement->save();

        return redirect("/advertisements/{$product->id}");

    }

    public function update(Request $request, $id, $pid)
    {
        if($request->hasFile('display_image'))
        {
            $file = $request->file('display_image');
            $fileNameWithExt = $request->file('display_image')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
        }

        if($request->hasFile('img1'))
        {
            $file = $request->file('img1');
            $fileNameWithExt = $request->file('img1')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
        }
        if($request->hasFile('img2'))
        {
            $file = $request->file('img2');
            $fileNameWithExt = $request->file('img2')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
        }
        if($request->hasFile('img3'))
        {
            $file = $request->file('img3');
            $fileNameWithExt = $request->file('img3')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
        }

        if($request->hasFile('img4'))
        {
            $file = $request->file('img4');
            $fileNameWithExt = $request->file('img4')->getClientOriginalName();
            $file->move('uploads', $fileNameWithExt);
        }

        DB::table('advertisements')
            ->where('id', $pid)
            ->update(['display_image' => $request->input('display_image')],
                    ['name' => $request->input('name')],
                    ['brand' => $request->input('brand')],
                    ['category_id' => $request->input('category_id')],
                    ['condition' => $request->input('condition')],
                    ['buying_year' => $request->input('buying_year')],
                    ['specification' => $request->input('specification')],
                    ['color' => $request->input('color')],
                    ['weight' => $request->input('weight')],
                    ['size' => $request->input('size')],
                    ['guarantee' => $request->input('guarantee')],
                    ['warranty' => $request->input('warranty')],
                    ['img1' => $request->input('img1')],
                    ['img2' => $request->input('img2')],
                    ['img3' => $request->input('img3')],
                    ['img4' => $request->input('img4')]
            );

            DB::table('advertisements')
            ->where('id', $id)
            ->update(['proposed_price' => $request->input('proposed_price')]
            );

        return redirect("/advertisements/{$pid}");
    }
}
