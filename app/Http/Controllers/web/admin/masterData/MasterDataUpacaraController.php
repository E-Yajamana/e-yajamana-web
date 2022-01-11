<?php

namespace App\Http\Controllers\web\admin\masterdata;

use App\Http\Controllers\Controller;
use App\Models\Upacara;
use Illuminate\Http\Request;

class MasterDataUpacaraController extends Controller
{
    public function indexDataUpacara(Request $request)
    {
        $dataUpacara = Upacara::all();
        return view('pages.admin.master-data.upacara.master-upacara-index',compact(['dataUpacara']));
    }


    public function createDataUpacara(Request $request)
    {
        return view('pages.admin.master-data.upacara.master-upacara-create');
    }

}
