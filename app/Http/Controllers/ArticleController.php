<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Pin;
use Image;

use Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['articles'] = Article::all();
        $data['categories']=Category::all();
        $data['comments']=Comment::all();
        $data['users']=User::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        
 
    
        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $name = time().".".$ext;
             $img = Image::make($request->image);
            $upload_path = 'articles/';
          
            $image_url = $upload_path.$name;
            $img->save($image_url);
        
   
            $article = new Article;
            $article->image_path = $image_url;
            $article->title = $request->title;
            $article->content = $request->content;
            $article->category_id = $request->category_name;      
            $article->save(); 
        }else{
         
            $article = new Article;
            $article->title = $request->title;
            $article->content = $request->content;
            $article->category_id = $request->category_name;      
            $article->save(); 
            
        }
            }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['article'] = Article::find($id);
        $data['categories'] = Category::all();
        return response()->json($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $name = time().".".$ext;
             $img = Image::make($request->image);
            $upload_path = 'articles/';
           
            $image_url =$upload_path.$name;
            $img->save($image_url);
        
   
            $article = Article::find($id);
            $n = '/';
            $article->image_path =$n.$image_url;
            $article->title = $request->title;
            $article->content = $request->content;
            $article->category_id = $request->category_name;      
            $article->save(); 
        }else{
         
            $article = Article::find($id);
            $article->title = $request->title;
            $article->content = $request->content;
            $article->category_id = $request->category_name;      
            $article->save(); 
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

            $article->delete();
  

    }


       public function addComment(Request $request,$id)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->article_id = $id;
        $comment->save();

        return response()->json($comment);
       
      }

      public function addPin(Request $request,$id){

        $pin = new Pin;
        $pin->password ='0000';
        $pin->user_id=$id;
        $pin->save();
          
      }

      public function pinedit(){
        $pin = Pin::all();
          return response()->json($pin);
      }
      

   public function pinupdate(Request $request,$id){
       $pin = Pin::find($id);
       $pin->password = $request->val0.$request->val1.$request->val2.$request->val3;
       $pin->user_id= $pin->user_id;
      
         
       $pin->save();
     

    
   }



}
