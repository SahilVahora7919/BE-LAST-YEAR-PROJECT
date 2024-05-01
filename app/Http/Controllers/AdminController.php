<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Banner;
use App\Models\User;
use PDF;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
    public function view_category()
    {
        $data = category::latest()->paginate(5);

        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {

        // Validate the request data
        $validatedData = $request->validate([
            'category' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'category_name'), // Ensure category_name is unique in the categories table
            ],
        ]);

        $data = new category;

        $data->category_name = $validatedData['category'];

        $image = $request->image;

        $imagename = time() . '.' . $image->getClientOriginalExtension();

        $request->image->move('categories', $imagename);

        $data->image = $imagename;

        $data->save();

        return redirect()->back()->with('message', "Category Added Successfully");
    }

    public function delete_category($id)
    {

        $data = category::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Category Deleted Successfully');

    }

    public function view_product()
    {
        $category = category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product = new product;

        $product->title = $request->title;

        $product->description = $request->description;

        $product->long_description = $request->long_description;

        $product->information = $request->information;

        $product->weight = $request->weight;

        $product->select = $request->select;

        $product->price = $request->price;

        $product->quantity = $request->quantity;

        $product->discount_price = $request->discount_price;

        $product->category = $request->category;

        $image = $request->image;

        $imagename = time() . '.' . $image->getClientOriginalExtension();

        $request->image->move('product', $imagename);

        $product->image = $imagename;

        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function show_product()
    {
        $product = product::latest()->paginate(10);
        return view('admin.show_product', compact('product'));
    }

    public function delete_product($id)
    {

        $product = product::find($id);

        $product->delete();

        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function update_product($id)
    {

        $product = product::find($id);

        $category = category::all();

        return view('admin.update_product', compact('product', 'category'));
    }

    public function update_product_confirm(Request $request, $id)
    {

        $product = product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->long_description = $request->long_description;
        $product->information = $request->information;
        $product->weight = $request->weight;
        $product->select = $request->select;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;

        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('product', $imagename);

            $product->image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product Updated Successfully');
    }

    public function order()
    {
        $order = Order::latest()->get();

        return view('admin.order', compact('order'));
    }

    public function delivered($id)
    {
        $order = order::find($id);

        $order->delivery_status = 'Delivered';
        $order->payment_status = 'Paid';

        $order->save();

        return redirect()->back();
    }

    public function print_pdf($id)
    {
        $order = order::find($id);

        $pdf = PDF::loadView('admin.invoice', compact('order'));

        return $pdf->download('order_details.pdf');
    }

    public function view_banner()
    {
        $banners = Banner::latest()->paginate(5);

        return view('admin.banner', compact('banners'));
    }

    public function add_banner(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        $banner = new Banner;

        $banner->banner_name = $request->banner_name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/banner'), $imageName);
            $banner->image = $imageName;
        }

        $banner->save();

        return redirect()->back()->with('message', "Banner Added Successfully");
    }

    public function delete_banner($id)
    {

        $data = Banner::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Banner Deleted Successfully');

    }
    public function view_users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function delete_users($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('message', 'User Deleted Successfully');
    }

    public function update_users($id)
    {
        $user = User::findOrFail($id);
        return view('admin.update_users', compact('user'));
    }

    public function update_users_confirm(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = $request->email_verified_at;
        $user->usertype = $request->usertype;
        $user->save();
        return redirect()->back()->with('message', 'User Details Updated Successfully');
    }
}

