<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PlanService;

class PlanController extends Controller
{
    
    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $input = $request->all();
        if (empty($input['page']) || (int)$input['page'] < 1)
        {
            $page = 1;
        } else {
            $page = $input['page'];
        }
        $plans = $this->planService->getPlanList();
        $pageHtml = \App\Tools\CustomPage::page($plans['total'], $plans['current_page'], $pnum = 10, $pagenum = 5, '/admin/plan?', $pagename = 'page',$anchor = '');
        return view('admin.plan.index', ['plans'=>$plans,
                                        'pageHtml'=>$pageHtml    
                                        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $planInfo = $this->planService->getPlanInfo($id);

        dd($planInfo->total);
        $toatl 
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
