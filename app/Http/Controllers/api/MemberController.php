<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\Routing\RequestContext;
use Validator;

class MemberController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return \App\Models\Member::orderBy('lastname', 'asc')->get();
    }

}
