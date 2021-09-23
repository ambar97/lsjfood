<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class SessionModel extends Model
{
    use HasFactory;

    protected $table = 'kategori_produks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'aktifity','insert','update' 
    ];

    public function insertSession($aktifity, $insert=NULL, $update=NULL)
    {
        DB::table('sessions')->insert(
            ['user' => Auth::user()->name, 'aktifity' => $aktifity,'insert'=>$insert, 'update'=>$update, 'created_at'=>now(),'updated_at'=>now()]
        );
    }
}
