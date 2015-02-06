<?php

namespace Cms;

class DashboardController extends \BaseController {

    public function getIndex()
    {
        return \View::make('cms.dashboard.index');
    }
} 