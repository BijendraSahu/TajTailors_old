<?php

namespace App\Http\Controllers;

use App\Categorymaster;
use App\ItemCategory;
use App\ItemCategorymaster;
use App\ItemImages;
use App\ItemMaster;
use App\itemMetamodel;
use App\ItemPrice;
use App\ItemSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Image;
use File;
use League\Flysystem\Exception;

session_start();

class ItemmasterController extends Controller
{
    public function items()
    {

        if ($_SESSION['admin_master'] != null) {
            $alldata = Categorymaster::where(['is_active' => 1])->paginate(10);
            $allcat = Categorymaster::where(['is_active' => 1])->get();
            $alldata1 = Categorymaster::where(['is_active' => 1])->get();
            $all_items = ItemMaster::orderBy('id','DESC')->paginate(10);
            return view('adminview.item_new', ['alldata' => $alldata, 'alldata1' => $alldata1, 'allcat' => $allcat, 'all_items' => $all_items])->with('no', 1);
        } else {
            return redirect('/adminlogin');
        }

    }

    public function send_cat_price()
    {

        $max_id = DB::select(" SELECT  max(id) as id FROM item_master");


        $getunit1 = request('getcid');
        $getqty1 = request('getqty');
        $getprice1 = request('getprice');
        $getspcl1 = request('getspcl');

        for ($i = 0; $i < sizeof($getprice1); $i++) {
            $item_price = new ItemPrice();
            $item_price->unit = $getunit1[$i];
            $item_price->qty = $getqty1[$i];
            $item_price->price = $getprice1[$i];
            $item_price->spl_price = $getspcl1[$i];
            $item_price->item_master_id = $max_id[0]->id;
            $item_price->save();
        }
        return 'success';


    }

    public function update_item()
    {

        $max_id = DB::select(" SELECT  max(id) as id FROM item_master");
        /*return $max_id[0]->id;*/

        $getunit11 = request('getcidone');
        $getqty11 = request('getqtyone');
        $getprice11 = request('getpriceone');
        $getspcl11 = request('getspclone');

        for ($i = 0; $i < sizeof($getprice11); $i++) {
            $item_price = new ItemPrice();
            $item_price->unit = $getunit11[$i];
            $item_price->qty = $getqty11[$i];
            $item_price->price = $getprice11[$i];
            $item_price->spl_price = $getspcl11[$i];
            $item_price->item_master_id = $max_id[0]->id;
            $item_price->save();
        }

        $delete_id = request('delet_id');
        ItemMaster::where('id', $delete_id)
            ->delete();
        ItemCategorymaster::where('item_master_id', $delete_id)
            ->delete();
        ItemPrice::where('item_master_id', $delete_id)
            ->delete();
        ItemImages::where('item_master_id', $delete_id)
            ->delete();
        $directory = 'p_img' . '/' . $delete_id;
        $success = File::deleteDirectory($directory);
        return 'success';

    }

    public function itemsadd(Request $request)
    {
        $item = new ItemMaster();
        $item->name = request('item_name');
        $item->description = request('temp');;
        $item->usage = request('item_usage');
        $item->specifcation = request('item_specification');
        $item->ingredients = request('item_ingredients');
        $item->nutrients = request('item_nutrients');
        $item->delivery = request('item_delivery');
        $item->meta_tag = request('item_metatag');
        $item->meta_keyword = request('item_metakeyword');
        $item->meta_description = request('item_metadescription');
        $item->price = request('price');
        $item->special_price = request('special_price');
        $item->save();

        $destinationPath = 'p_img/' . $item->id . '/';
        if (request('file') != null) {
            foreach (request('file') as $file) {
                $item_img = new ItemImages();
                $temp = time() . '_' . $file->getClientOriginalName();
                $file->move($destinationPath, $temp);
                $item_img->image = $temp;
                $item_img->item_master_id = $item->id;
                $item_img->save();
            }
        }

        $finalcat = request('category');
        if (request('category') != null) {
            for ($i = 0; $i < sizeof($finalcat); $i++) {
                $item_category = new ItemCategorymaster();
                $item_category->category_id = $finalcat[$i];
                $item_category->item_master_id = $item->id;
                $item_category->save();
            }
        }

        $count = count(request('size')) / 1;
        $item_unit = request('size');
        $u = 0;
        /*$k = 1;
        $cp = 2;
        $p = 3;
        $s = 4;
        $q = 5;
        $pr = 6;*/
        for ($i = 0; $i < $count; $i++) {
            $price = new ItemSize();
            $price->item_master_id = $item->id;
            $price->size = $item_unit[$u];
           /* $price->weight = $item_unit[$k];
            $price->cost_price = $item_unit[$cp];
            $price->price = $item_unit[$p];
            $price->spl_price = $item_unit[$s];
            $price->qty = $item_unit[$q];
            $price->product_id = $item_unit[$pr];*/
            $price->save();
            $u = $u + 1;
//            $k = $pr + 2;
//            $cp = $pr + 3;
//            $p = $pr + 4;
//            $s = $pr + 5;
//            $q = $pr + 6;
//            $pr = $pr + 7;
        }

        return redirect('items')->with('message', 'Product has been added');


        /* $directory='p_img/1';
         $success = File::deleteDirectory($directory);
         return 'success';*/


    }

    public function itemshow($id)
    {
        $findthis = $id;
        $all_items = ItemMaster::find($id);
        $all_items_price = ItemPrice::where(['item_master_id' => $findthis])->get();
        $all_items_cat = ItemCategorymaster::where(['item_master_id' => $findthis])->get();
        $all_items_image = ItemImages::where(['item_master_id' => $findthis])->get();
        return view('adminview.view_item', ['all_items' => $all_items, 'all_items_price' => $all_items_price, 'all_items_cat' => $all_items_cat, 'all_items_image' => $all_items_image]);

    }

    public function edit_item_show($id)
    {
        $findthis = $id;
        $allcat = Categorymaster::where(['is_active' => 1])->get();
        $all_items = ItemMaster::find($id);
        $all_items_price = ItemPrice::where(['item_master_id' => $findthis])->get();
        $all_items_cat = ItemCategorymaster::where(['item_master_id' => $findthis])->get();
        $all_items_image = ItemImages::where(['item_master_id' => $findthis])->get();
        $all_items_meta = itemMetamodel::where(['item_master_id' => $findthis])->get();
        return view('adminview.edit_item', ['all_items' => $all_items, 'all_items_price' => $all_items_price, 'all_items_cat' => $all_items_cat, 'all_items_image' => $all_items_image, 'allcat' => $allcat, 'all_items_meta' => $all_items_meta,'findthis'=>$findthis]);

    }

    public function deactivate_item()
    {
        /*  $reqidd=request('IDD');*/
        $data = array(
            'is_active' => '0'
        );
        ItemMaster::where('id', request('IDD'))
            ->update($data);
        return 1;

    }
    public function activatemy_item()
    {
        /*  $reqidd=request('IDD');*/
        $data = array(
            'is_active' => '1'
        );
        ItemMaster::where('id', request('IDD'))
            ->update($data);
        return 1;

    }

    public function itemeditpost(Request $request)
    {


        $update_this= request('i_id');

        $data = array(
            'name' => request('item_name'),
            'description' => request('temp'),
            'usage' => request('item_usage'),
            'specifcation' => request('item_specification'),
            'ingredients' => request('item_ingredients'),
            'nutrients' => request('item_nutrients'),
            'delivery' => request('item_delivery'),
            'meta_tag' => request('item_metatag'),
            'meta_keyword' => request('item_metakeyword'),
            'meta_description' => request('item_metadescription'),
        );
        ItemMaster::where('id', request('i_id'))
            ->update($data);

        $destinationPath = 'p_img/' . $update_this . '/';
        if (request('file') != null) {
            foreach (request('file') as $file) {
                $item_img = new ItemImages();
                $temp = time() . '_' . $file->getClientOriginalName();
                $file->move($destinationPath, $temp);
                $item_img->image = $temp;
                $item_img->item_master_id = $update_this;
                $item_img->save();
            }
        }



        ItemCategory::where('item_master_id', $update_this)
            ->delete();

        $finalcat = request('category');
        if (request('category') != null) {
            for ($i = 0; $i < sizeof($finalcat); $i++) {
                $item_category = new ItemCategorymaster();
                $item_category->category_id = $finalcat[$i];
                $item_category->item_master_id = $update_this;
                $item_category->save();
            }
        }

        ItemPrice::where('item_master_id', $update_this)
            ->delete();
        $count = count(request('unit')) / 6;
        $item_unit = request('unit');
        $u = 0;
        $k = 1;
        $cp = 2;
        $p = 3;
        $s = 4;
        $q = 5;
        $pr = 6;
        for ($i = 0; $i < $count; $i++) {
            if ($item_unit[$u] != "")
            {
                $price = new ItemPrice();
            $price->item_master_id = $update_this;
            $price->unit = $item_unit[$u];
            $price->weight = $item_unit[$k];
            $price->cost_price = $item_unit[$cp];
            $price->price = $item_unit[$p];
            $price->spl_price = $item_unit[$s];
            $price->qty = $item_unit[$q];
            $price->product_id = $item_unit[$pr];
            $price->save();
                $u = $pr+ 1;
                $k = $pr + 2;
                $cp = $pr + 3;
                $p = $pr + 4;
                $s = $pr + 5;
                $q = $pr + 6;
                $pr = $pr + 7;
        }
        }

        return redirect('items')->with('message', 'Product has been Updated');

    }

    public function delete_item_pic()
    {
        try{
            $imagename = request('i_name');
            $m_id = request('m_id');
            $item_id = request('item_id');

            ItemImages::where('id', $m_id)
                ->delete();
            $image_path = 'p_img/' . $item_id . '/' . $imagename;
            if (File::exists($image_path)) {
                File::delete($image_path);
                return '1';
            }
        }catch(\Exception $ex)
        {
            return $ex->getMessage();
        }

    }

    public function searchtable(Request $request)
    {
//        return $request->input('catid');
        try{
            if(request('nameis')!="" && request('catid')=="")
            {
                $allrow=ItemMaster::where('name','like','%'.request('nameis').'%')->get();
                return $allrow;
            }
            else if(request('nameis')=="" && request('catid')!="")
            {
                $cid=request('catid');
                $allrow=DB::select("select im.* from item_category ic,item_master im where im.id=ic.item_master_id and ic.category_id=$cid");
                return $allrow;
            }
            else if(request('nameis')!="" && request('catid')!="")
            {
                $cid=request('catid');
                $search=request('nameis');
                $allrow=DB::select("select im.* from item_category ic,item_master im where im.id=ic.item_master_id and ic.category_id=$cid and im.name like '%$search%'");
                return $allrow;

            }

        }catch(\Exception $ex)
        {
            return $ex->getMessage();
        }


    }
}