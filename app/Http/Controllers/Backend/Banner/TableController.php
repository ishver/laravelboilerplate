<?php

namespace App\Http\Controllers\Backend\Banner;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Banner\BannerRepository;

/**
 * Class TableController.
 */
class TableController extends Controller
{
    /**
     * @var BannerRepository
     */
    protected $banners;

    /**
     * @param BannerRepository $banners
     */
    public function __construct(BannerRepository $banners)
    {       
        $this->banners = $banners;       
    }

    /**
     * @param BannerRepository $request
     *
     * @return mixed
     */
    public function __invoke()
    {


        return Datatables::of($this->banners->getForDataTable())
            ->escapeColumns(['name', 'sort'])
            ->addColumn('image', function ($banner) {
                    return '<a target="_blank" href="'.$banner->image.'">'.trans('labels.general.view').'</span>';
            })
             ->addColumn('url', function ($banner) {
                    return '<a target="_blank" href="'.$banner->url.'">'.$banner->url.'</span>';
            })
            ->addColumn('actions', function ($banner) {
                return $banner->action_buttons;
            })
            ->make(true);
    }
}
