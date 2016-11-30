<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Auth;
use App\Http\Requests;
use DB;

class ArticleController extends Controller
{
    private $user;

	public function __construct()
	{
		$this->user = Auth::user();
	}

	public function NewArticle()
	{
		return view('learning.newarticle', ['user' => $this->user]);
	}

	public function createarticle(Request $request)
	{
		$article = new Article;
		$article->title = $request->get('title');
		$article->content = $request->get('content');
		$article->user_id = $this->user->id;
		$article->save();
		if (!$request->ajax())
		{
			return Redirect('/learning');
		}
	}

    public function listArticles(){

    	$articles = Article::all();
    	
        return view('learning.learning-resources', ['articles' => $articles]);
    }

    public function showSingleArticle($id){
    	$article = Article::find($id);
       	return view('learning.article', ['article' => $article]);
    }
}
