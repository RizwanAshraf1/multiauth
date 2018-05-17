<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view("product.index", compact("products", $products));
    }

    public function productInfo(Request $request)
    {
        if ($request->isMethod("GET")) {
            $product = $request->session()->get("product");
            return view("product.info", compact("product", $product));
        } else {
            $validateData = $request->validate([
                'name' => 'required|unique:products',
                'amount' => 'required|numeric',
                'company' => 'required',
                'available' => 'required',
                'description' => 'required',
            ]);
            if (empty($request->session()->get("product"))) {
                $product = new Product();
                $product->fill($validateData);
                $request->session()->put("product", $product);
            } else {
                $product = $request->session()->get("product");
                $product->fill($validateData);
                $request->session()->put("product", $product);

            }
            return redirect(route("product.image-upload"));
        }

    }

    public function imageUpload(Request $request)
    {
        if ($request->isMethod("GET")) {
            $product = $request->session()->get("product");
            return view("product.image-upload", compact("product", $product));
        } else {
            $this->validate($request, [
                "imageUpload" => "required|image|max:2048",
            ]);

            $filename = "productImage_" . time() . "." . $request->imageUpload->getClientOriginalExtension();
            $request->imageUpload->storeAs("productimages", $filename);
            $product = $request->session()->get("product");
            $product->productimg = $filename;
            $request->session()->put('product', $product);

            return redirect(route("product.details"));

        }

    }
    public function saveProduct(Request $request)
    {

        if ($request->isMethod("GET")) {
            $product = $request->session()->get("product");
            return view("product.details", compact("product", $product));
        } else {
            $product = $request->session()->get("product");
            $product->save();
            $product = $request->session()->forget('product');;

            return redirect(route("product.all"));

        }
    }

}
