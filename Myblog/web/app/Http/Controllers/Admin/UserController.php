<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Hash;

class UserController extends Controller
{
	//用户列表页————————————————————————————————————————————————————————————————————————-
    public function getList(Request $request)
    {
    	$search = $request -> input('search','');
        $count = $request -> input('count');
    	// dump($search);
    	//获取user数据表中的数据
    	$data = User::where('username','like','%'.$search.'%')->paginate($count);
    	// dd($data);
    	$counts = User::count();
   
        return view('admin.user.list',['data'=>$data,'counts'=>$counts,'request'=>$request->all()]);
    	
    }

    //用户添加页——————————————————————————————————————————————————————————————————————————
    public function getAdd()
    {
    	return view('admin.user.add');
    }

    //用户添加方法————————————————————————————————————————————————————————————————————————
    public function postInsert(Request $request)
    {
    	// $user = new Users;
    	$username = $request-> username;
    	$sex = $request-> sex;
    	$password = $request-> password;
    	$phone = $request-> phone;
    	$email = $request-> email;
    	$profile = $request-> profile;
    	 //创建文件 处理图片
        $profile = $request ->file('profile');
        //创建文件名
        $temp_name = str_random(20);
        //获取后缀名
        $ext = $profile -> getClientOriginalExtension();
        //拼接文件名
        $name = $temp_name.'.'.$ext;
        //拼接路径
        $dir = './uploads/'.date('Ymd',time());
        //拼接向数据库储存的文件路径
        $filename = ltrim($dir.'/'.$name,'.');
           // dump($filename);
        //执行上传
        $profile -> move($dir,$name);
    	$users = new User;
    	$users -> username = $username;
    	$users -> sex = $sex;
    	$users -> password = $password;
    	$users -> phone = $phone;
    	$users -> email = $email;
    	$users -> profile = $filename;
    	$res = $users -> save();

    	if($res)
    	{
    		echo 'ok';
    		return redirect('/admin/user/list');
    		// layer.open({title: '在线调试',content: '可以填写任意的layer代码'});   
    	}else
    	{
    		return back();
    	}
    	  
    	// if($users)
    	// {
    	// 	alert('修改成功');
    	// }


    	// $this -> validate($request,[
    	// 	'username' => 'required|unique:users|regex:/^[a-zA-Z]{1}[\w]{5,17}$/',
    	// 	'password' => 'required',
    	// ],[
    	// 	'username.regex' => '用户格式不正确',
    	// 	'username.unique' => '用户名已存在',
    	// ]);
    	// $user = new User;
    	// $user -> username = $request -> input('username');
    	// $user -> password = Hash::make($request -> input('password'));
    	// $user -> save();
    	// $users = new User;
    	// $user -> 
    	
    }

  


    //用户删除————————————————————————————————————————————————————————————————————————————————————————-
    public function getDelete($id)
    {
    	$res =  User::destroy($id);

       
            return back();
      
    }

    //用户恢复界面—————————————————————————————————————————————————————————————————————————————————————
    public function getDellist(Request $request)
    {
        $search = $request -> input('search','');
    	// $flights = User::paginate(5);
    	$flights = User::onlyTrashed()->where('username','like','%'.$search.'%')->paginate(5);
    	$count = User::count();
        return view('admin.user.dellist',['deldata'=>$flights,'count'=>$count]);
    }

    //用户恢复方法————————————————————————————————————————————————————————————————————————————————
   	public function getRollback($id)
   	{
   		$res =  User::withTrashed()
            ->where('id', $id)
            ->restore();
       if($res){
            return redirect('/admin/user/dellist');
       }else{
            return back();
       }
   	}

   	//用户修改页面——————————————————————————————————————————————————————————————————————————————————————
   	public function getUpdatelist($id)
   	{
   		$data = User::find($id);
   		return view('/admin/user/update',['data'=>$data]);
   		
   	}

   	//用户修改方法——————————————————————————————————————————————————————————————————————————————————————
   	public function postUpdate(Request $request,$id)
   	{
   		$users = User::find($id);
   		// $users = new User;
   		
   		
    	$users -> username = $request -> input('username');
    	$users -> sex = $request -> input('sex');
    	$users -> password = Hash::make($request -> input('password'));
    	$users -> phone = $request -> input('phone');
    	$users -> email = $request -> input('email');
    	$users -> profile = $request -> input('profile');
    	$users -> save();

    	return redirect('/admin/user/list');
   	}
}
