<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use File;
use Session;
use App\Photo;
use App\Product;
use Illuminate\Http\Request;

class PhotoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    // SHOW PHOTOS FOR PRODUCT BY ID
    public function show($id) {
      $count = Photo::where('product_id', $id)->count();
      $photos = Photo::where('product_id', $id)->orderBy('order', 'asc')->get();
      $metaImage = Photo::where('product_id', $id)->where('is_meta', 1)->first();
      $productModel = Product::where('id', $id)->select('model')->first();
      return view('manage.products.photos')->withProductId($id)->withPhotos($photos)->withCount($count)->withMetaImage($metaImage)->withProductModel($productModel);
    }
    // STORE UPLOADED PHOTO
    public function store(Request $request) {
        // COUNT UPLOADED PHOTOS TO THIS PRODUCT
        $count = Photo::where('product_id', '=', $request->product_id)->count();
        // VALIDATE UPLOADED PHOTO
        $this->validate($request, array(
            'photo'   => 'image|max: 10000|dimensions: min_width=700, min_height=700',
        ));

        $filename = null;

        if($request->hasFile('photo')) {
          $uploader_id = Auth::id();
          $photos = new Photo;
          $image = $request->file('photo');
          $filename = $request->product_model.'_'.$uploader_id.'_'.time().'.'.$image->getClientOriginalExtension();
          // FULL SIZE
          $fb = Image::make($image)->fit(700)->orientate()->sharpen(5)->save('images/'.$filename);
          // HALF SIZE
          Image::make($image)->fit(350)->orientate()->sharpen(5)->save('images/half/'.$filename);
          // THUMB SIZE
          Image::make($image)->fit(100)->orientate()->sharpen(5)->save('images/thumbs/'.$filename);
          // SAVE TO DATABASE
          $photos->product_id = $request->product_id;
          $photos->photo = $filename;
          // IF THERE NO META IMAGE
          $checkMeta = Photo::where('product_id', $request->product_id)->where('is_meta', 1)->first();
          if(empty($checkMeta)) {
            // CREATE META IMAGE
            Image::canvas(1200, 630)->insert(public_path(config('app.prefix')).'meta-image-bgr.png')->insert($fb, 'center')->save('images/meta/'.$filename);
            // SAVE TO DATABASE
            $photos->is_meta = 1;
          }
          // ORDER PHOTOS
          if($count == null) {
              $photos->order = 1;
          }
          elseif($count == 1) {
              $photos->order = 2;
          }
          elseif($count == 2) {
              $photos->order = 3;
          }
          elseif($count == 3) {
              $photos->order = 4;
          }
          elseif($count == 4) {
              $photos->order = 5;
          }
          $photos->save();
        }
        $photosToView = Photo::where('product_id', '=', $request->id)->get();
        Session::flash('success', 'СНИМКАТА ВИ Е КАЧЕНА УСПЕШНО !');
        return redirect()->route('manage.photos.show', $request->product_id)->withPhotos($photosToView)->withCount($count);
    }
    // CHANGE ORDER
    public function moveRight(Request $request) {
        $photo = Photo::where('id', '=', $request->photo_id)->first();
        $photoOrder = $photo->order;
        if($photoOrder == 1) {
            $secondPhoto = Photo::where('product_id', $request->product_id)->where('order', 2)->first();
            if($secondPhoto) {
                $secondPhoto->order = 1;
                $secondPhoto->save();
                $photo->order = 2;
                $photo->save();
            }
        } elseif ($photoOrder == 2) {
            $thirdPhoto = Photo::where('product_id', $request->product_id)->where('order', 3)->first();
            if($thirdPhoto) {
                $thirdPhoto->order = 2;
                $thirdPhoto->save();
                $photo->order = 3;
                $photo->save();
            }
        } elseif ($photoOrder == 3) {
            $fourthPhoto = Photo::where('product_id', $request->product_id)->where('order', 4)->first();
            if($fourthPhoto) {
                $fourthPhoto->order = 3;
                $fourthPhoto->save();
                $photo->order = 4;
                $photo->save();
            }
        } elseif ($photoOrder == 4) {
            $fifthPhoto = Photo::where('product_id', $request->product_id)->where('order', 5)->first();
            if($fifthPhoto) {
                $fifthPhoto->order = 4;
                $fifthPhoto->save();
                $photo->order = 5;
                $photo->save();
            }
        }
        return redirect()->back();
    }
    // CHANGE ORDER
    public function moveLeft(Request $request) {
        $photo = Photo::where('id', '=', $request->photo_id)->first();
        $photoOrder = $photo->order;
        if($photoOrder == 2) {
            $firstPhoto = Photo::where('product_id', $request->product_id)->where('order', 1)->first();
            if($firstPhoto) {
                $firstPhoto->order = 2;
                $firstPhoto->save();
                $photo->order = 1;
                $photo->save();
            }
        } elseif ($photoOrder == 3) {
            $secondPhoto = Photo::where('product_id', $request->product_id)->where('order', 2)->first();
            if($secondPhoto) {
                $secondPhoto->order = 3;
                $secondPhoto->save();
                $photo->order = 2;
                $photo->save();
            }
        } elseif ($photoOrder == 4) {
            $thirdPhoto = Photo::where('product_id', $request->product_id)->where('order', 3)->first();
            if($thirdPhoto) {
                $thirdPhoto->order = 4;
                $thirdPhoto->save();
                $photo->order = 3;
                $photo->save();
            }
        } elseif ($photoOrder == 5) {
            $fourthPhoto = Photo::where('product_id', $request->product_id)->where('order', 4)->first();
            if($fourthPhoto) {
                $fourthPhoto->order = 5;
                $fourthPhoto->save();
                $photo->order = 4;
                $photo->save();
            }
        }
        return redirect()->back();
    }
    // CHANGE META IMAGE
    public function meta(Request $request) {
        // GET SELECTED PHOTO
        $delete = Photo::where('product_id', $request->product_id)->where('is_meta', 1)->first();
        // IF THERE SELECTED PHOTO
        if(isset($delete->photo)) {
            File::delete(public_path('images/meta/' . $delete->photo));
        }
        // SET ALL PRODUCT-PHOTOS 'IS_META' TO 0
        Photo::where('product_id', $request->product_id)->update(['is_meta' => 0]);
        // SET 'IS_META' TO 1
        $photo = Photo::where('product_id', $request->product_id)->where('id', $request->photo_id)->first();
        $photo->is_meta = 1;
        $photo->save();
        // CREATE META IMAGE
        $image = Image::make(public_path('images/' . $request->photo));
        $filename = $request->photo;
        Image::canvas(1200, 630)->insert(public_path(config('app.prefix')).'meta-image-bgr.png')->insert($image, 'center')->save( 'images/meta/' . $filename );
        // REDIRECT BACK
        return redirect()->back();
    }
    // ROTATE IMAGE
    public function rotateLeft(Request $request) {
        // GET PHOTO
        $photo = Image::make(public_path('images/' . $request->photo));
        // GET UPLOADER ID
        $uploader_id = Auth::id();
        // SET NEW FILE NAME
        $filename = $request->product_model.'_'.$uploader_id.'_'.time().'.'.$photo->extension;
        // ROTATE RIGHT
        $photo->rotate(90);
        // SAVE NEW PHOTO
        // FULL SIZE
        $photo->save(public_path('images/' . $filename));
        // CHECK IF IS META IMAGE
        $checkMeta = Photo::where('photo', $request->photo)->where('is_meta', 1)->first();
        // IF TRUE - CHANGE META IMAGE
        if(!empty($checkMeta)) {
          // CREATE META IMAGE
          Image::canvas(1200, 630)->insert(public_path(config('app.prefix')).'meta-image-bgr.png')->insert($photo, 'center')->save('images/meta/'.$filename);
        }
        // HALF SIZE
        $photo->fit(350)->save(public_path('images/half/' . $filename));
        // THUMB SIZE
        $photo->fit(100)->save(public_path('images/thumbs/' . $filename));
        // FIND AND DELETE OLD PHOTO FROM DATABASE
        $oldPhoto = Photo::where('photo', '=', $request->photo)->first();
        $photoOrder = $oldPhoto->order;
        $oldPhoto->delete();
        // STORE NEW PHOTO IN DATABASE
        $newPhoto = new Photo;
        $newPhoto->photo = $filename;
        $newPhoto->product_id = $request->product_id;
        $newPhoto->order = $photoOrder;
        if(!empty($checkMeta)) {
          $newPhoto->is_meta = 1;
        }
        $newPhoto->save();
        // DELETE OLD PHOTO FILES
        File::delete(public_path('images/' . $request->photo));
        File::delete(public_path('images/half/' . $request->photo));
        File::delete(public_path('images/thumbs/' . $request->photo));
        File::delete(public_path('images/meta/' . $request->photo));
        // REDIRECT BACK TO PAGE
        return redirect()->back();
    }
    // ROTATE IMAGE
    public function rotateRight(Request $request) {
        // GET PHOTO
        $photo = Image::make(public_path('images/' . $request->photo));
        // GET UPLOADER ID
        $uploader_id = Auth::id();
        // SET NEW FILE NAME
        $filename = $request->product_model.'_'.$uploader_id.'_'.time().'.'.$photo->extension;
        // ROTATE RIGHT
        $photo->rotate(-90);
        // SAVE NEW PHOTO
        // FULL SIZE
        $photo->save(public_path('images/' . $filename));
        // CHECK IF IS META IMAGE
        $checkMeta = Photo::where('photo', $request->photo)->where('is_meta', 1)->first();
        // IF TRUE - CHANGE META IMAGE
        if(!empty($checkMeta)) {
          // CREATE META IMAGE
          Image::canvas(1200, 630)->insert(public_path(config('app.prefix')).'meta-image-bgr.png')->insert($photo, 'center')->save('images/meta/'.$filename);
        }
        // HALF SIZE
        $photo->fit(350)->save(public_path('images/half/' . $filename));
        // THUMB SIZE
        $photo->fit(100)->save(public_path('images/thumbs/' . $filename));
        // FIND AND DELETE OLD PHOTO FROM DATABASE
        $oldPhoto = Photo::where('photo', '=', $request->photo)->first();
        $photoOrder = $oldPhoto->order;
        $oldPhoto->delete();
        // STORE NEW PHOTO IN DATABASE
        $newPhoto = new Photo;
        $newPhoto->photo = $filename;
        $newPhoto->product_id = $request->product_id;
        $newPhoto->order = $photoOrder;
        if(!empty($checkMeta)) {
          $newPhoto->is_meta = 1;
        }
        $newPhoto->save();
        // DELETE OLD PHOTO FILES
        File::delete(public_path('images/' . $request->photo));
        File::delete(public_path('images/half/' . $request->photo));
        File::delete(public_path('images/thumbs/' . $request->photo));
        File::delete(public_path('images/meta/' . $request->photo));
        // REDIRECT BACK TO PAGE
        return redirect()->back();
    }
    // DELETE PHOTO
    public function delete(Request $request) {
        // FIND AND DELETE PHOTO FROM DATABASE
        $photo = Photo::where('photo', '=', $request->photo)->first();
        $photoOrder = $photo->order;
        $photo->delete();
        // CHANGE ORDER
        if($photoOrder == 1) {
            $secondPhoto = Photo::where('product_id', $request->product_id)->where('order', 2)->first();
            if($secondPhoto) {
                $secondPhoto->order = 1;
                $secondPhoto->save();
            }
            $thirdPhoto = Photo::where('product_id', $request->product_id)->where('order', 3)->first();
            if($thirdPhoto) {
                $thirdPhoto->order = 2;
                $thirdPhoto->save();
            }
            $fourthPhoto = Photo::where('product_id', $request->product_id)->where('order', 4)->first();
            if($fourthPhoto) {
                $fourthPhoto->order = 3;
                $fourthPhoto->save();
            }
            $fifthPhoto = Photo::where('product_id', $request->product_id)->where('order', 5)->first();
            if($fifthPhoto) {
                $fifthPhoto->order = 4;
                $fifthPhoto->save();
            }
        } elseif ($photoOrder == 2) {
            $thirdPhoto = Photo::where('product_id', $request->product_id)->where('order', 3)->first();
            if($thirdPhoto) {
                $thirdPhoto->order = 2;
                $thirdPhoto->save();
            }
            $fourthPhoto = Photo::where('product_id', $request->product_id)->where('order', 4)->first();
            if($fourthPhoto) {
                $fourthPhoto->order = 3;
                $fourthPhoto->save();
            }
            $fifthPhoto = Photo::where('product_id', $request->product_id)->where('order', 5)->first();
            if($fifthPhoto) {
                $fifthPhoto->order = 4;
                $fifthPhoto->save();
            }
        } elseif ($photoOrder == 3) {
            $fourthPhoto = Photo::where('product_id', $request->product_id)->where('order', 4)->first();
            if($fourthPhoto) {
                $fourthPhoto->order = 3;
                $fourthPhoto->save();
            }
            $fifthPhoto = Photo::where('product_id', $request->product_id)->where('order', 5)->first();
            if($fifthPhoto) {
                $fifthPhoto->order = 4;
                $fifthPhoto->save();
            }
        } elseif ($photoOrder == 4) {
            $fifthPhoto = Photo::where('product_id', $request->product_id)->where('order', 5)->first();
            if($fifthPhoto) {
                $fifthPhoto->order = 4;
                $fifthPhoto->save();
            }
        }
        // DELETE PHOTO FILES
        File::delete(public_path('images/' . $request->photo));
        File::delete(public_path('images/half/' . $request->photo));
        File::delete(public_path('images/thumbs/' . $request->photo));
        File::delete(public_path('images/meta/' . $request->photo));
        // REDIRECT BACK TO PAGE
        return redirect()->back();
    }

}
