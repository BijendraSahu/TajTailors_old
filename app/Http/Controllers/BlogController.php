<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use App\BlogCategoryRecord;
use App\Blogmodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

session_start();

class BlogController extends Controller
{
    public function blog()
    {
        $data = BlogCategory::get();
        $blogdata = Blogmodel::where(['is_active' => '1'])->orderBy('id', 'desc')->paginate(5);
        return view('adminview.blog', ['data' => $data, 'blogdata' => $blogdata]);
    }

    public function blogpic()
    {
        $maxid = DB::select('select max(id) as myid from blog');
        $destinationPath = 'blog_pic/' . $maxid[0]->myid . '/';
        $file = request('file');
        $temp = time() . '_' . $file->getClientOriginalName();
        $file->move($destinationPath, $temp);

        $blogdata = array(
            'img_url' => $temp,
        );
        Blogmodel::where('id', $maxid[0]->myid)
            ->update($blogdata);
        return 1;

    }

    public function addblogcat()
    {
        $data = new BlogCategory();
        $data->name = request('cat_name');
        $data->meta_title = request('meta_title');
        $data->meta_keyword = request('meta_keyword');
        $data->meta_description = request('meta_description');
        $data->save();
        return 'success';
    }

    public function blogpost()
    {

        $data = new Blogmodel();
        $data->title = request('title');
        $data->description = request('description');
        $data->meta_title = request('blog_meta_title');
        $data->meta_keyword = request('blog_meta_keyword');
        $data->meta_description = request('blog_meta_description');
        $data->created_date = date("d-m-y");
        $data->created_by = $_SESSION['admin_master']['username'];
        $data->save();

        $mydata = request('mycatid');
        for ($i = 0; $i < sizeof($mydata); $i++) {
            $dcat_data = new BlogCategoryRecord();
            $dcat_data->blog_id = $data->id;
            $dcat_data->cat_id = $mydata[$i];
            $dcat_data->save();
        }

        return 'success';

    }
    public function upblogpost()
    {
        try{
            $data = array(
                'title' => request('title'),
                'description' => request('description'),
                'meta_title' => request('blog_meta_title'),
                'meta_keyword' => request('blog_meta_keyword'),
                'meta_description' => request('blog_meta_description'),

            );
            Blogmodel::where('id', request('udid'))
                ->update($data);

            Blogmodel::where('blog_id', request('udid'))
                ->delete();
            $mydata = request('mycatid');
            for ($i = 0; $i < sizeof($mydata); $i++) {
                $dcat_data = new BlogCategoryRecord();
                $dcat_data->blog_id = request('udid');
                $dcat_data->cat_id = $mydata[$i];
                $dcat_data->save();
            }

            return 'success';
        }catch(\Exception $ex)
        {
            return $ex->getMessage();
        }


    }
    public function updateblog($id)
    {
        $blogdata=Blogmodel::where(['id'=>$id,'is_active'=>'1'])->first();
        $data = BlogCategory::get();
        return view('adminview.update_blog',['blogdata'=>$blogdata,'data'=>$data]);
    }
}
