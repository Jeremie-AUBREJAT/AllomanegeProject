<?php

namespace App\Http\Controllers;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function editPicture()
    {
        $pictures = Picture::all();
        return view("picture/edit")->with("pictures",$pictures);
    }

    public function update($id){
        $picture = Picture::find($id);
        return view("picture/update")->with("picture",$picture);
    }
    public function updatePicture( $request, $id)
    {
        $update = Picture::find($id);
        $update->images = $request->input('images');
        $update->save();

        return redirect("carousel/view");
    }
}
