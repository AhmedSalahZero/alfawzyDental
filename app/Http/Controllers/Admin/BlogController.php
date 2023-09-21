<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Author;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    //
    use Upload_Files;

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = Blog::query()->latest();
            return DataTables::of($admins)
                ->addColumn('action', function ($admin) {

                    $edit = '';
                    $delete = '';


                    return '
                            <button ' . $edit . '  class="editBtn btn rounded-pill btn-primary waves-effect waves-light"
                                    data-id="' . $admin->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="las la-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button ' . $delete . '  class="btn rounded-pill btn-danger waves-effect waves-light delete"
                                    data-id="' . $admin->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="las la-trash-alt"></i>
                                </span>
                            </span>
                            </button>
                       ';


                })

                ->editColumn('image', function ($admin) {
                    return '
                              <a data-fancybox="" href="' . get_file($admin->image) . '">
                                <img height="60px" src="' . get_file($admin->image) . '">
                            </a>
                             ';
                })
                ->editColumn('author_id', function ($row) {

                    return $row->author->name??'';

                })

                ->editColumn('blog_category_id', function ($row) {

                    return $row->category->title??'';

                })

                    ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.CRUDS.blogs.index');
    }


    public function create()
    {
        $authors=Author::get();
        $categories=BlogCategory::get();

        return view('Admin.CRUDS.blogs.parts.create',compact('authors','categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif',
            'brief' => 'required',
            'desc' => 'required',
            'author_id'=>'required|exists:authors,id',
            'blog_category_id'=>'required|exists:blog_categories,id',


        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('blogs', $request->file('image'), null);



        Blog::create($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }


    public function show($id)
    {


        //
    }


    public function edit($id)
    {
        $row=Blog::findOrFail($id);
        $authors=Author::get();
        $categories=BlogCategory::get();
        return view('Admin.CRUDS.blogs.parts.edit', compact('row','authors','categories'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif',
            'brief' => 'required',
            'desc' => 'required',
            'author_id'=>'required|exists:authors,id',
            'blog_category_id'=>'required|exists:blog_categories,id',
        ]);

        if ($request->image)
            $data["image"] = $this->uploadFiles('blogs', $request->file('image'), null);




        $row=Blog::findOrFail($id);

        $row->update($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy( $id)
    {
        $row=Blog::findOrFail($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun
}
