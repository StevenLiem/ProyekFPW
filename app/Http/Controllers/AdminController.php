<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Manga;
use App\Models\Users;
use App\Rules\MangaZipRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AdminController extends Controller
{
    //
    function gotoAdmin(){
        $users_data = Users::where('role', 'user')->get();
        return view('admin.adminHome', ["users_data" => $users_data]);
    }

    public function gotoMasterManga(){
        $manga_list = Manga::withTrashed()->get();
        return view("admin.masterManga", ['manga_list'=>$manga_list]);
    }

    public function gotoAddManga(){
        return view("admin.addManga");
    }

    public function banUser(Request $request){
        $user = Users::find($request->id);
        if ($user->status == "active"){
            $status = "banned";
        }
        else{
            $status = "active";
        }

        $result = $user->update([
            'status' => $status
        ]);

        if ($result){
            return redirect()->route('master');
        }
    }

    public function addNewManga(Request $request){
        $validation = [
            'title' => 'required',
            'author' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'synopsis' => 'required',
            'mangaFile' => ['required', 'file', 'mimes:zip', new MangaZipRule],
        ];
        $messages = [
            'genre.required' => 'Select at least 1 genre',
        ];
        $this->validate($request, $validation, $messages);

        // dd("MASOK");

        $zip = new ZipArchive();
        $zip->open($request->file('mangaFile'));

        $manga = new Manga();
        $manga->title = $request->title;
        $manga->id_author = $request->author;
        $manga->id_artist = $request->artist;
        $manga->synopsis = $request->synopsis;
        $manga->total_page = $zip->numFiles;
        $manga->save();

        Storage::disk('public')->makeDirectory('manga/'.$manga->id);
        $zip->extractTo(storage_path('app/public/manga/'.$manga->id));
        $zip->close();

        foreach ($request->genre as $genre){
            DB::connection("conn_proyek")->table('manga_genre')->insert([
                "id_manga"=>$manga->id,
                "id_genre"=>$genre
            ]);
        }

        return back()->with('msg', 'Manga Successfully Added');
    }

    public function deleteManga(Request $request){
        $manga = Manga::withTrashed()->find($request->id);
        if($manga->trashed()){
            $result = $manga->restore();
        }else{
            $result = $manga->delete();
        }

        if($result){
            return redirect()->route('masterManga');
        }
    }

    public function addAuthor(Request $request){
        $validation = [
            'name' => 'required|unique:author'
        ];
        $this->validate($request, $validation);

        Author::insert([
            "name" => $request->name
        ]);
        return response()->json(['success'=>'Author Added']);
    }

    public function addArtist(Request $request){
        $validation = [
            'name' => 'required|unique:artist'
        ];
        $this->validate($request, $validation);

        Artist::insert([
            "name" => $request->name
        ]);
        return response()->json(['success'=>'Artist Added']);
    }

    public function addGenre(Request $request){
        $validation = [
            'name' => 'required|unique:genre'
        ];
        $this->validate($request, $validation);

        Genre::insert([
            "name" => $request->name
        ]);
        return response()->json(['success'=>'Genre Added']);
    }

    public function updateAuthor(Request $request){
        $validation = [
            'name' => 'required|unique:author'
        ];
        $this->validate($request, $validation);

        Author::where('id', $request->id)->update([
            'name' => $request->name
        ]);
        return response()->json(['success'=>'Author Updated']);
    }

    public function updateArtist(Request $request){
        $validation = [
            'name' => 'required|unique:artist'
        ];
        $this->validate($request, $validation);

        Artist::where('id', $request->id)->update([
            'name' => $request->name
        ]);
        return response()->json(['success'=>'Artist Updated']);
    }

    public function updateGenre(Request $request){
        $validation = [
            'name' => 'required|unique:genre'
        ];
        $this->validate($request, $validation);

        Genre::where('id', $request->id)->update([
            'name' => $request->name
        ]);
        return response()->json(['success'=>'Genre Updated']);
    }
}
