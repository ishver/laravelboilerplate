<?php

namespace App\Events\Backend\Banner;

use Illuminate\Queue\SerializesModels;

/**
 * Class Updated.
 */
class Updated
{
    use SerializesModels;

    /**
     * @var
     */
    public $banner;

    /**
     * @param $banner
     */
    public function __construct($banner)
    {
        $this->banner = $banner;
    }
}
