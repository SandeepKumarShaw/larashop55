<?php

namespace App\Http\Controllers;

use App\CmsPage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CmsPage = CmsPage::all();
        return view('admin.cms.Page', compact('CmsPage'));
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
        if(isset($request->status)){
            $status = 0;
        }else{
            $status = 1;
        }

        //image
        $image = $request->file('featureimage');
        $slug = str_slug($request->slug);
        if(isset($image)){
            //make unique name image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('feature')){
                Storage::disk('public')->makeDirectory('feature');
            }

            $featureImage = Image::make($image->getRealPath())->resize(1600,1066)->save( storage_path('app/public' . $imageName ), 90 );
            Storage::disk('public')->put('feature/'.$imageName,$featureImage);
        }else{
            $imageName = "img.jpg";
        }

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
    public function show(CmsPage $cmsPage, $id)
    {
        $cmsPage = CmsPage::find($id);
        return view('admin.cms.show', compact('cmsPage'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsPage $cmsPage, $id)
    {
        $cmsPage = CmsPage::find($id);
        return view('admin.cms.editPage', compact('cmsPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CmsPage $cmsPage, $id)
    {
        $CmsPage = CmsPage::find($id);

        $this->validate($request, [
            'title' => 'required'
        ]);
        if(isset($request->status)){
            $status = 0;
        }else{
            $status = 1;
        }

        $image = $request->file('featureimage');
        $slug  = str_slug($request->slug);
        $cmsPage = CmsPage::find($id);
        if(isset($image)){

            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check category dirr is exists
            if(!Storage::disk('public')->exists('feature')){
                Storage::disk('public')->makeDirectory('feature');
            }       

            //Delete Old Images
            if(Storage::disk('public')->exists('feature/'.$cmsPage->featureImg)){
                Storage::disk('public')->delete('feature/'.$cmsPage->featureImg);
            }
            //resize image for category and upload
             $cmsPageImage = Image::make($image->getRealPath())->resize(1600,1066)->save( storage_path('app/public' . $imagename ), 90 );
            Storage::disk('public')->put('feature/'.$imagename,$cmsPageImage);           
        }else{
            $imagename = $cmsPage->featureImg;
        }

        $CmsPage->title = $request->title;
        $CmsPage->slug = $request->slug;
        $CmsPage->status = $status;
        $CmsPage->featureImg = $imagename;
        $CmsPage->description = $request->description;
        $CmsPage->save();
        Toastr::success('Page Successfully Updated:', 'success');
        return redirect()->route('pages.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsPage $cmsPage, $id)
    {

        $cmsPage = CmsPage::find($id);
        $cmsPage->delete();
        
        Toastr::success('Page Successfully Deleted:', 'success');
        return redirect()->route('pages.index');
    }
}
