<?php

namespace App\Repositories\Backend\Banner;

use App\Models\Banner\Banner;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

use App\Events\Backend\Banner\Created;
use App\Events\Backend\Banner\Deleted;
use App\Events\Backend\Banner\Updated;

/**
 * Class BannerRepository.
 */
class BannerRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Banner::class;    

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getAll($order_by = 'sort', $sort = 'asc')
    {
        return $this->query()
            ->with('users', 'permissions')
            ->select([
                config('access.roles_table').'.id',
                config('access.roles_table').'.name',
                config('access.roles_table').'.all',
                config('access.roles_table').'.sort',
            ]);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        //DB::statement(DB::raw('set @rownum=0'));
        return $this->query()            
            ->select([
                //DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                config('access.banners_table').'.id',
                config('access.banners_table').'.name',
                config('access.banners_table').'.image',
                config('access.banners_table').'.url',
                config('access.banners_table').'.order_number'
            ]);
    }

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        $all = true ;

        DB::transaction(function () use ($input, $all) {
            $banner = self::MODEL;
            $banner = new $banner();

            $fksiteid = 1;
            $fklanguageid = 1;

            $slug = 1;
            $image = 1;
            $url = 1;
            $status = 1;
            $order_number = 1;

        
            //dd($input['data']['name']);
            
            $banner->fksiteid = $fksiteid;
            $banner->fklanguageid = $fklanguageid;


            $banner->name = $input['name'];

            $banner->slug = $slug;
            $banner->text = $input['text'];
            $banner->sidetext = $input['sidetext'];
            $banner->image = $image;
            $banner->url = $url;
            $banner->status = $status;
            $banner->order_number = $order_number;

            $banner->save();
            throw new GeneralException(trans('exceptions.backend.access.roles.create_error'));
        });
    }


    /**
     * @param Model $banner
     * @param  $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update(Model $banner, array $input)
    {   
        $banner->name = $input['name'];
        $banner->text = $input['text'];
        $banner->sidetext = $input['sidetext'];
        $banner->url = $input['url'];
        $banner->order_number = $input['order_number'];
        $banner->status = $input['status'];
        $banner->save();
    }



    /**
     * @param Model $banner
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $banner)
    {
        //Would be stupid to delete the administrator banner
        if ($banner->id == 1) { //id is 1 because of the seeder
            throw new GeneralException(trans('exceptions.backend.banner.cant_delete_admin'));
        }

        //Don't delete the banner is there are banners associated
        // if ($banner->banners()->count() > 0) {
        //     throw new GeneralException(trans('exceptions.backend.banner.has_users'));
        // }

        DB::transaction(function () use ($banner) {
            //Detach all associated roles
            $banner->permissions()->sync([]);

            if ($banner->delete()) {
                event(new Deleted($banner));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.banner.delete_error'));
        });
    }

   
}
