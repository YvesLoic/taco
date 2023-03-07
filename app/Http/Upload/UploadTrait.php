<?php

namespace App\Http\Upload;

use App\Models\Car;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    /**
     * Function to store user picture
     *
     * @param Request $req request
     * @param User $user user
     *
     * @return void
     */
    protected function uploadUserPicture(Request $req, User $user)
    {
        $file = $req->picture;
        $file_name = $user->first_name . '_' . uniqid(time()) . '.' . $file->extension();
        $path = public_path('/assets/images/users');
        $user->picture = $file_name;
        $file->move($path, $file_name);
    }

    protected function uploadCarPictures($file, Car $car)
    {
        if (is_array($file)) {
            foreach ($file as $pic) {
                $name = $car->id . '_' . uniqid(time()) . '.' . $pic->extension();
                $pic->move(public_path('/assets/images/cars'), $name);
                Picture::create([
                    'src' => $name,
                    'car_id' => $car->id,
                ]);
            }
        } else {
            $name = $car->id . '_' . uniqid(time()) . '.' . $file->extension();
            $file->move(public_path('/assets/images/cars'), $name);
            Picture::create([
                'src' => $name,
                'car_id' => $car->id,
            ]);
        }
    }
}
