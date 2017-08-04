<?php
namespace SunnyShift\LaravelUploader\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use SunnyShift\LaravelUploader\Services\FileUpload;

class UploaderController extends BaseController
{
    public function upload(Request $request, FileUpload $fileUpload){
        $inputName = 'file';
        $directory = '{Y}/{m}/{d}';
        $disk = config('filesystems.default', 'public');
        if (!$request->hasFile($inputName)) {
            return [
                'success' => false,
                'error' => 'no file found.',
            ];
        }
        $file = $request->file($inputName);

        return $fileUpload->store($file, $disk, $directory);
    }

    public function delete(Request $request)
    {
        $result = ['result' => app(FileUpload::class)->delete($request->get('file'))];

        return $result;
    }
}