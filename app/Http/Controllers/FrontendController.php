<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\User;
use App\Models\ProductVaration;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class FrontendController extends Controller
{
   
	
    public function index(Request $request){
        return redirect()->to('/admin/dashboard');
    }
    
    public function calculator(Request $request)
    {
        $json = '{
            "id": "57790",
            "parent_id": "0",
            "name": "Maintenance Fee Calculator",
            "slug": "maintenance-fee-calculator",
            "description": "Calculate rising maintenance fees",
            "sidebar": "",
            "language": "40",
            "webhook": "",
            "params": {
                "showFormulaError": false,
                "oldTheme": "bordered",
                "FontSize": 1,
                "helpTextColor": "#50596f",
                "formulaFontColor": "#50596f",
                "helpTextAlign": "left",
                "calcAlign": 0,
                "showFullMenu": 1,
                "separatorThousand": ",",
                "separatorDecimal": ".",
                "newInputDesign": 1,
                "useLocalStorageCache": 1,
                "calcNameFontWeight": "400",
                "theme": "",
                "colorScheme": "red",
                "calcBackground": "light-blue",
                "shadows": 1,
                "calcWidth": 0,
                "fieldNameFontColor": "#50596f",
                "fontColor": "#50596f",
                "inputfontColor": "#50596f",
                "labelAlign": "left",
                "contentAlign": "left",
                "InputAlign": "left",
                "formulaAlign": "left",
                "fieldNameFontWeight": "400",
                "descriptionFontWeight": "400",
                "inputFontWeight": "400",
                "formulaFontWeight": "400",
                "fontWeight": "400",
                "transparentBackground": 1,
                "easyredmineCrmItemAmount": [],
                "easyredmineCrmItemUnit": [],
                "easyredmineCrmItemName": [],
                "easyredmineCrmItemDescription": [],
                "easyredmineCrmItemPricePerUnit": [],
                "easyredmineCrmItemTotalPrice": [],
                "easyredmineCrmItemDiscount": [],
                "easyredmineCrmItemProductCode": [],
                "easyredmineCrmItemControlField": "amount",
                "easyredmineCrmItemCount": 1,
                "easyredmineCrmPriceBookQuoteActive": 1,
                "easyredmineCrmEasyPriceBookPriceId": [],
                "easyredminePriceBookQuoteActive": 1
            },
            "created": "2018-10-05 18:11:35",
            "modified": "2022-10-20 23:51:23",
            "userId": "26011",
            "finished": "1",
            "private": "0",
            "signature": "1",
            "notify": "1",
            "numberOfPages": "1",
            "isTemplate": "0",
            "fields": [
                {
                    "id": "282971",
                    "calculator_id": "57790",
                    "field_id": "3",
                    "name": "Current Maintenance Fee  -  Ex: 877.90",
                    "sizeX": "6",
                    "sizeY": "4",
                    "page": "1",
                    "row": "0",
                    "col": "0",
                    "ordering": "0",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": "1000",
                    "decimalPlaces": "0",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "17",
                    "fontSize": "16",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "forceString": false,
                        "focus": false,
                        "isRequired": 0,
                        "InputAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "527484",
                    "calculator_id": "57790",
                    "field_id": "3",
                    "name": "Mortgage Annually (Calculated at 10 yr Max)",
                    "sizeX": "6",
                    "sizeY": "4",
                    "page": "1",
                    "row": "0",
                    "col": "6",
                    "ordering": "1",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": "",
                    "decimalPlaces": "0",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "17",
                    "fontSize": "16",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "forceString": false,
                        "focus": false,
                        "isRequired": 0,
                        "InputAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "282972",
                    "calculator_id": "57790",
                    "field_id": "1",
                    "name": "Annual Percentage Increase",
                    "sizeX": "12",
                    "sizeY": "6",
                    "page": "1",
                    "row": "4",
                    "col": "0",
                    "ordering": "2",
                    "hint": "",
                    "prefix": "",
                    "postfix": "",
                    "value": "5",
                    "decimalPlaces": "0",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "17",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "valueMin": 1,
                        "valueMax": 20,
                        "step": 1,
                        "fieldShow": 1,
                        "minHeight": 2,
                        "scale": "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20",
                        "scalePrefix": "",
                        "scalePostfix": "",
                        "showTicksValues": 1,
                        "additionalInput": 0,
                        "hideSelectionBar": 0,
                        "forceDecimalPlaces": 0,
                        "InputAlign": "left",
                        "selectionBarGradient": {},
                        "logScale": 0,
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "283167",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "30 Year Cost of Ownership!!",
                    "sizeX": "12",
                    "sizeY": "4",
                    "page": "1",
                    "row": "10",
                    "col": "0",
                    "ordering": "3",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": " F527510   + F527484 *10 ",
                    "decimalPlaces": "2",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "24",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "282973",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "First Yearly Cost",
                    "sizeX": "6",
                    "sizeY": "3",
                    "page": "1",
                    "row": "14",
                    "col": "0",
                    "ordering": "4",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": "(F282972/100) *(F282971)+ F282971 ",
                    "decimalPlaces": "2",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "20",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "conditionalFields": [],
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "283007",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "Cumulative Cost",
                    "sizeX": "6",
                    "sizeY": "3",
                    "page": "1",
                    "row": "14",
                    "col": "6",
                    "ordering": "5",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": " F282973 + F527484 ",
                    "decimalPlaces": "0",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "20",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "527497",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "5 Year Maintenance Cost",
                    "sizeX": "6",
                    "sizeY": "3",
                    "page": "1",
                    "row": "17",
                    "col": "0",
                    "ordering": "6",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": " F282971 * (1 +  F282972 /100 )^5  ",
                    "decimalPlaces": "2",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "20",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "conditionalFields": [],
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "527500",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "5 Year Cumulative Cost",
                    "sizeX": "6",
                    "sizeY": "3",
                    "page": "1",
                    "row": "17",
                    "col": "6",
                    "ordering": "7",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": " F282973 *6   ",
                    "decimalPlaces": "0",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "20",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "527503",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "10 Year Maintenance Cost",
                    "sizeX": "6",
                    "sizeY": "3",
                    "page": "1",
                    "row": "20",
                    "col": "0",
                    "ordering": "8",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": " F282971 * (1 +  F282972 /100 )^10",
                    "decimalPlaces": "2",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "20",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "conditionalFields": [],
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "527505",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "10 Year Cumulative Cost",
                    "sizeX": "6",
                    "sizeY": "3",
                    "page": "1",
                    "row": "20",
                    "col": "6",
                    "ordering": "9",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": " F527500 + ( F527503 *5) ",
                    "decimalPlaces": "0",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "20",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "527507",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "20 Year Maintenance Cost",
                    "sizeX": "6",
                    "sizeY": "3",
                    "page": "1",
                    "row": "23",
                    "col": "0",
                    "ordering": "10",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": " F282971 * (1 +  F282972 /100 )^20 ",
                    "decimalPlaces": "2",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "20",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "conditionalFields": [],
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "527508",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "20 Year Cumulative Cost",
                    "sizeX": "6",
                    "sizeY": "3",
                    "page": "1",
                    "row": "23",
                    "col": "6",
                    "ordering": "11",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": " F527505 + ( F527507 *10)  ",
                    "decimalPlaces": "0",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "20",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "527509",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "30 Year Maintenance Cost",
                    "sizeX": "6",
                    "sizeY": "3",
                    "page": "1",
                    "row": "26",
                    "col": "0",
                    "ordering": "12",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": " F282971 * (1 +  F282972 /100 )^30 ",
                    "decimalPlaces": "2",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "20",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "conditionalFields": [],
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                },
                {
                    "id": "527510",
                    "calculator_id": "57790",
                    "field_id": "4",
                    "name": "30 Year Cumulative Cost",
                    "sizeX": "6",
                    "sizeY": "3",
                    "page": "1",
                    "row": "26",
                    "col": "6",
                    "ordering": "13",
                    "hint": "",
                    "prefix": "$",
                    "postfix": "",
                    "value": " F527508 + ( F527509 *10) ",
                    "decimalPlaces": "0",
                    "width": "100",
                    "labelShow": "1",
                    "labelSize": "20",
                    "fontSize": "14",
                    "fontColor": "",
                    "backgroundColor": "",
                    "params": {
                        "fieldShow": 1,
                        "minHeight": 2,
                        "formulaAlign": "",
                        "transparentBackground": 2,
                        "oneLineField": 0
                    },
                    "options": []
                }
            ],
            "tables": [],
            "tags": []
        }';
        
return        $config = json_decode($json, true);
// return $config->param;
        return view('calculator', ['config' => $config]);
    }
	
	public function get_variant($id)
	{
		return $data = ProductVaration::find($id);
	}

    public function home()
    {
        return view('frontend.soon');
        // $featured=Product::where('status','active')->orderBy('price','DESC')->limit(2)->get();
        // $posts=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        // // return $banner;
        // $products=Product::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        // $category=Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
        // return $category;
        // return view('frontend.index')
        //         ->with('featured',$featured)
        //         ->with('posts',$posts)
        //         ->with('banners',$banners)
        //         ->with('product_lists',$products)
        //         ->with('category_lists',$category); 
    }   

    public function aboutUs(){
        return view('frontend.pages.about-us');
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function productDetail($slug){
         $product_detail= Product::getProductBySlug($slug);
        // dd($product_detail);
        return view('frontend.pages.product_detail')->with('product_detail',$product_detail);
    }

    public function productGrids(){
        $products=Product::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids);
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(9);
        }
        // Sort by name , price, category

      
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productLists(){
        $products=Product::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(16);
        }
        // Sort by name , price, category

      
        return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productFilter(Request $request){
            $data= $request->all();
            // return $data;
            $showURL="";
            if(!empty($data['show'])){
                $showURL .='&show='.$data['show'];
            }

            $sortByURL='';
            if(!empty($data['sortBy'])){
                $sortByURL .='&sortBy='.$data['sortBy'];
            }

            $catURL="";
            if(!empty($data['category'])){
                foreach($data['category'] as $category){
                    if(empty($catURL)){
                        $catURL .='&category='.$category;
                    }
                    else{
                        $catURL .=','.$category;
                    }
                }
            }

            $brandURL="";
            if(!empty($data['brand'])){
                foreach($data['brand'] as $brand){
                    if(empty($brandURL)){
                        $brandURL .='&brand='.$brand;
                    }
                    else{
                        $brandURL .=','.$brand;
                    }
                }
            }
            // return $brandURL;

            $priceRangeURL="";
            if(!empty($data['price_range'])){
                $priceRangeURL .='&price='.$data['price_range'];
            }
            if(request()->is('e-shop.loc/product-grids')){
                return redirect()->route('product-grids',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
            }
            else{
                return redirect()->route('product-lists',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
            }
    }
    public function productSearch(Request $request){
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $products=Product::orwhere('title','like','%'.$request->search.'%')
                    ->orwhere('slug','like','%'.$request->search.'%')
                    ->orwhere('description','like','%'.$request->search.'%')
                   // ->orwhere('summary','like','%'.$request->search.'%')
                    ->orwhere('price','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')
                    ->paginate('9');
        return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
    }

    public function productBrand(Request $request){
        $products=Brand::getProductByBrand($request->slug);
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productCat(Request $request){
		
		$cat = Category::where('slug',$request->slug)->first();
		//return $category;
		$category = $cat->id;
		$products = Product::where(function ($query) use ($category) {
			$query->where('cat_id', 'LIKE', "%{$category}%");
			//$query->where('cat_id', $category);
		})->paginate(20);
		
		//return $products;
		
		
		
        //$products=Category::getProductByCat($request->slug);
		
		//$category = Category::with('products')->where('slug',$request->slug)->first();
		//$categories = $category->id;
		//$productss = Product::whereHas('categories', function ($query) use ($categories) {
		//	$query->whereIn('category_id', $categories);
		//})->get();
        //return $productss;
        //$recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        //if(request()->is('e-shop.loc/product-grids')){
        //    return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        //}
        //else{
            return view('frontend.pages.product-lists')->with('products',$products);
        //}

    }
    public function productSubCat(Request $request)
	{
       	$cat = Category::where('slug',$request->slug)->first();
		$subcat = SubCategory::where('slug',$request->sub_slug)->first();
		//return $cat;
		$category = $cat->id;
		$subcategory = $subcat->id;
		$products = Product::where(function ($query) use ($subcategory) {
			$query->where('sub_cat_id',  $subcategory );
		})->paginate(20);
		//$products=SubCategory::getProductBySubCat($request->sub_slug);
        // return $products;
        //$recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        //if(request()->is('e-shop.loc/product-grids')){
         //   return view('frontend.pages.product-grids')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        //}
        //else{
            return view('frontend.pages.product-lists')->with('products',$products);
        //}

    }
	
	public function productChildCat(Request $request)
	{
		
		$childcat =  ChildCategory::where('slug',$request->child_slug)->first();
		//return $cat;
		$childcategory = $childcat->id;
		$products = Product::where(function ($query) use ($childcategory) {
			$query->where('child_cat_id', 'LIKE', "%{$childcategory}%");
		})->paginate(20);
		
		//$category =  ChildCategory::where('slug',$request->child_slug)->first();
		
		
		//return $request->child_slug;
        //$products= Product::where('child_cat_id',$category->id)->paginate(20);
        // return $products[0]->sub_products;
        //$recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        //if(request()->is('e-shop.loc/product-grids')){
        //    return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
        //}
        //else{
            return view('frontend.pages.product-lists')->with('products',$products);
        //}

    }

    public function blog(){
        $post=Post::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=PostCategory::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            return $cat_ids;
            $post->whereIn('post_cat_id',$cat_ids);
            // return $post;
        }
        if(!empty($_GET['tag'])){
            $slug=explode(',',$_GET['tag']);
            // dd($slug);
            $tag_ids=PostTag::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // return $tag_ids;
            $post->where('post_tag_id',$tag_ids);
            // return $post;
        }

        if(!empty($_GET['show'])){
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate($_GET['show']);
        }
        else{
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate(9);
        }
        // $post=Post::where('status','active')->paginate(8);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogDetail($slug){
        $post=Post::getPostBySlug($slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // return $post;
        return view('frontend.pages.blog-detail')->with('post',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogSearch(Request $request){
        // return $request->all();
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $posts=Post::orwhere('title','like','%'.$request->search.'%')
            ->orwhere('quote','like','%'.$request->search.'%')
            ->orwhere('summary','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('slug','like','%'.$request->search.'%')
            ->orderBy('id','DESC')
            ->paginate(8);
        return view('frontend.pages.blog')->with('posts',$posts)->with('recent_posts',$rcnt_post);
    }

    public function blogFilter(Request $request){
        $data=$request->all();
        // return $data;
        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $tagURL="";
        if(!empty($data['tag'])){
            foreach($data['tag'] as $tag){
                if(empty($tagURL)){
                    $tagURL .='&tag='.$tag;
                }
                else{
                    $tagURL .=','.$tag;
                }
            }
        }
        // return $tagURL;
            // return $catURL;
        return redirect()->route('blog',$catURL.$tagURL);
    }

    public function blogByCategory(Request $request){
        $post=PostCategory::getBlogByCategory($request->slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post->post)->with('recent_posts',$rcnt_post);
    }

    public function blogByTag(Request $request){
        // dd($request->slug);
        $post=Post::getBlogByTag($request->slug);
        // return $post;
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    // Login
    public function login(){
        return view('frontend.pages.login');
    }
    public function loginSubmit(Request $request){
        $data= $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'])){
            Session::put('user',$data['email']);
            request()->session()->flash('success','Successfully login');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        return back();
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return back();
        }
    } 
    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);
    }
    // Reset password
    public function showResetForm(){
        return view('auth.passwords.reset');
    }

    public function subscribe(Request $request){
        if(! Newsletter::isSubscribed($request->email)){
                Newsletter::subscribePending($request->email);
                if(Newsletter::lastActionSucceeded()){
                    request()->session()->flash('success','Subscribed! Please check your email');
                    return redirect()->route('home');
                }
                else{
                    Newsletter::getLastError();
                    return back()->with('error','Something went wrong! please try again');
                }
            }
            else{
                request()->session()->flash('error','Already Subscribed');
                return back();
            }
    }
    
}
