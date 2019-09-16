<?php

namespace App\Http\Controllers;

use App\CmsPage;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cms.Page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.addPage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        if(empty($request->status)){
            $status = 0;
        }else{
            $status = 1;
        }
        $imageName = "default.png";

        $CmsPage = new CmsPage;
        $CmsPage->title = $request->title;
        $CmsPage->slug = $request->slug;
        $CmsPage->status = $status;
        $CmsPage->featureImg = $imageName;
        $CmsPage->description = $request->description;
        $CmsPage->save();
        Toastr::success('Page Successfully Save:', 'success');
        return redirect()->route('pages.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CmsPage $cmsPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsPage $cmsPage)
    {
        //
    }
}
