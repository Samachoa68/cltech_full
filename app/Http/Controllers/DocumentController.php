<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DocumentController extends Controller
{

    public function AuthLogin()
    {

        if (Session::get('login_normal')) {

            $admin_id = Session::get('admin_id');
        } else {
            $admin_id = Auth::id();
        }
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function upload_file()
    {

        $filename = 'file.pdf';
        $filePath = public_path('upload\document\New Microsoft Word Document.pdf');
        $fileData = File::get($filePath);
        Storage::cloud()->put($filename, $fileData);
        return 'File PDF Uploaded';
    }

    public function create_document()
    {
        Storage::Cloud()->put('test.txt', 'Test create');
        // Storage::disk('Second_google')->put('test.txt','Google drive 2');
        dd('Created');
    }

    public function upload_image()
    {
        $filename = 'Chapter4-567xdcv.jpg';
        $filePath = public_path('frontend/images/chapter/Chapter4-567xdcv.jpg');
        $fileData = File::get($filePath);
        Storage::cloud()->put($filename, $fileData);
        return 'Image Uploaded';
    }
    public function upload_video()
    {
        $filename = 'video_hd720.mp4';
        $filePath = public_path('frontend/images/samplevideo.mp4');
        $fileData = File::get($filePath);
        Storage::cloud()->put($filename, $fileData);
        return 'Video Uploaded';
    }

    public function rename_folder()
    {

        $folderinfo = collect(Storage::cloud()->listContents('/', false))
            ->where('type', 'dir')
            ->where('name', 'document')
            ->first();

        Storage::cloud()->move($folderinfo['path'], 'Storage');
        dd('renamed folder');
    }
    public function delete_folder()
    {

        $folderinfo = collect(Storage::cloud()->listContents('/', false))
            ->where('type', 'dir')
            ->where('name', 'Storage')
            ->first();

        Storage::cloud()->delete($folderinfo['path']);
        dd('deleted folder');
    }

    public function list_document()
    {
        $dir = '/';
        $recursive = true; // Có lấy file trong các thư mục con không?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive))
            ->where('type', '!=', 'dir');

        return $contents;
    }

    public function read_data()
    {
        $this->AuthLogin();

        $dir = '/';
        $recursive = false; // Có lấy file trong các thư mục con không?

        $contents = collect(Storage::cloud()->listContents($dir, $recursive))
            ->where('type', '!=', 'dir');

        return view('admin.document.read_data')->with(compact('contents'));
    }

    public function download_document($path,$name){        
        
        $contents = collect(Storage::cloud()->listContents('/', false))
        ->where('type', '=', 'file')
        ->where('path', '=', $path)
        ->first(); 
        
        $filename_download = $name;       
    
        $rawData = Storage::cloud()->get($path);

        return response($rawData, 200)
        ->header('Content-Type', $contents['mimetype'])
        ->header('Content-Disposition', " attachment; filename=$filename_download ");
        
        return redirect()->back();
    }

    public function delete_document($path){

        $fileinfo = collect(Storage::cloud()->listContents('/', false))
        ->where('type', 'file')
        ->where('path', $path)
        ->first();

        Storage::cloud()->delete($fileinfo['path']);
       
        return redirect()->back();
    }
}
