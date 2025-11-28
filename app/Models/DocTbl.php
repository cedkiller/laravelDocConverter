<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocTbl extends Model
{
    protected $table = 'doc_tbl';
    protected $primaryKey = 'docID';
    public $timestamps = false;
    protected $fillable = [
        'doc_name',
        'doc_docx_path',
        'doc_pdf_path'
    ];
}
