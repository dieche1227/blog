<?php



namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GoodsImgService;


class GoodsImgController extends Controller
{
    protected $goodsImgService;
    
     public function __construct(GoodsImgService $goodsImgService)
     {
        $this->goodsImgService = $goodsImgService;
     }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        
        $res = $this->goodsImgService->create($data);
        return $res;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 给图片排序
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //var_dump($request->input('orderBy'));die;
        $str = $request->input('orderBy');
        $res = $this->goodsImgService->sortimg($str);

        // dd($res);
        if( $res['status'] )
        {
            return ['status'=>true,'msg'=>'操作成功'];
        } else {
            return ['status'=>false,'msg'=>'操作失败'];
        }
        //explode(",", $str);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $res = $this->goodsImgService->delete($id);
        return $res;
    }
}
