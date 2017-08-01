<?php

namespace App\Events\Backend\Banner;

use Illuminate\Queue\SerializesModels;

/**
 * Class Created.
 */
class Created
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
