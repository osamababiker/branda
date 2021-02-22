<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AgarImg;

class DropzoneController extends Controller
{

  public function dropzoneStore(Request $request){

      $images = $request->file('files');
      $agar_id = (int) $_GET['agar_id'];

      foreach ($images as $image) {
        $imageName = time().'_'. rand(1000, 9999). '.' .$image->extension();
        $image->move(public_path('agar/images'),$imageName);
        AgarImg::create([
            'agar_id' => $agar_id,
            'img_wide' => $imageName,
            'thumbnail' => $imageName
        ]);
      }
      
      return response()->json([
        'code' => 200,
        'success' => true
      ]);

  }
}
