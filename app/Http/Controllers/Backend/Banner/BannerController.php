<?php

namespace App\Http\Controllers\backend\Banner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner\Banner;

use App\Repositories\Backend\Banner\BannerRepository;
use App\Http\Requests\Backend\Banner\StoreBannerRequest;
use App\Http\Requests\Backend\Banner\ManageBannerRequest;
use App\Http\Requests\Backend\Banner\UpdateBannerRequest;



class BannerController extends Controller
{

    protected $banners;

    /**
     * @param BannerRepository $banner
     */
    public function __construct(BannerRepository $banners)
    {
        $this->banners = $banners;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(banner $banner , StoreBannerRequest $request)
    {

        $fk_site_id = '1';
        $file = $this->postImage($request);
        $request->image = $file;
        $image = $file;
        
        //$this->banners->create($banner, $request->only('name', 'text', 'sidetext', 'url', 'order_number', 'status', 'image'));
        $this->banners->create($request->only('name', 'text', 'sidetext', 'url', 'order_number', 'status', 'image'));
        return redirect()->route('admin.banner.index')->withFlashSuccess(trans('alerts.backend.banner.created'));
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
    public function edit(banner $banner, ManageBannerRequest $request)
    {
        return view('backend.banner.edit')->withBanner($banner);
        //return view('backend.banner.edit',['banner'=>$banner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(banner $banner, UpdateBannerRequest $request)
    {
        $fk_site_id = '1';
        if($request->hasFile('image')){
            $file = $this->postImage($request);
            $banner->image = $file;
            $this->banners->update($banner, $request->only('name', 'text', 'sidetext', 'url', 'order_number', 'status', 'image'));
        }else{
            $this->banners->update($banner, $request->only('name', 'text', 'sidetext', 'url', 'order_number', 'status'));
        }
        return redirect()->route('admin.banner.index')->withFlashSuccess(trans('alerts.backend.banner.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(banner $banner, ManageBannerRequest $request)
    {
        //$this->banners->delete($banner);
        return redirect()->route('admin.banner.index')->withFlashSuccess(trans('alerts.backend.banner.deleted'));
    }



    public function postImage(Request $request)
    {
            $fk_site_id = '1';
            $this->validate($request, [
                'image' => 'required|max:2048',
            ]);
            //$this->validate($request, ['image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:1024']);
            $image = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();
            $generate_name = 'Zwaluw_'.md5(uniqid(rand(), true));
            if (!file_exists('images/banner/'.$fk_site_id.'/')) {
                mkdir('images/banner/'.$fk_site_id.'/', 0777, true);
            }
            $file_name = $generate_name . '.' . $extension;
            $image->move('images/banner/'.$fk_site_id.'/', $file_name);
            return $file_name;
    }

}
