<?php

namespace App\Events\Backend\Banner;

use Illuminate\Queue\SerializesModels;

/**
 * Class Deleted.
 */
class Deleted
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
