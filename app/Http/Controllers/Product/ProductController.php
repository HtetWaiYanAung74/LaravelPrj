<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ProductController extends Controller
{

/*	public function __construct() {
		$this->middleware('auth')->except(['index','show']);
	}*/

    public function index() 
    {	
/* 		$data = [
			["id"=>1, "title"=>"1st Article"],
			["id"=>2, "title"=>"2nd Article"]
		];
		
		return view('Articles.index', compact('data'));
	
		return view('Articles.index', [
			'products'=>$data
		]); */
		
//		$article = Article::all();

		$article = Article::latest()->paginate(5);
		
		return view('Articles.index', compact('article'));	
	}

	public function show($id) 
	{
		$detail = Article::find($id);
		
		return view('Articles.details', compact('detail'));
	}

	public function create() 
	{
		$category =  Category::all();
		
		return view('Articles.add', compact('category'));
	}

	public function store(Request $request) 
	{
		$validator = validator(request()->all(),[
			'title'=>'required',
			'content'=>'required',
			'category_id'=>'required'
		]);

		if ($validator->fails()) {
			return back()->withErrors($validator);
		}

		$article = new Article;

		//$obj -> data_in_db = $request() -> form_name
		$article->title = request()->title;
		$article->content = request()->content;
		$article->category_id = request()->category_id;
		$article->save();

		return redirect('/articles');
	}

	public function edit($id) 
	{
		$edit = Article::find($id);
		$category =  Category::all();

		return view('Articles.update', compact('edit','category'));
	}

	public function update(Request $request, $id) 
	{
        Article::findOrFail($id)->update([
            // 'title'=>$request->get('title'),
            // 'content'=>$request->get('content'),
            // 'category_id'=>$request->get('category_id'),
            'title'=>request()->title,
            'content'=>request()->content,
            'category_id'=>request()->category_id,
        ]);
        
        return redirect('/articles')->with('success','Article has been successfully updated...');
    }

	public function destroy($id) 
	{
		$delete = Article::find($id);	
		$delete -> delete();

		return redirect('/articles')->with('info','Article has been deleted successfully');
	}
}
