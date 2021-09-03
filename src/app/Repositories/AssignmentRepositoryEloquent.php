<?php

namespace App\Repositories;

use App\Exports\AssignmentExport;
use App\Models\Assignment;
use Illuminate\Support\Facades\File;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AssignmentRepository;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
/**
 * Class AssignmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AssignmentRepositoryEloquent extends BaseRepository implements AssignmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Assignment::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function dataTables()
    {
        $book = Assignment::select((array('id',
                            'title',
                            'author_name',
                            'created_at')))
                            ->OrderBy('created_at','DESC');
        return Datatables::of($book)
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('Y-m-d'); // human readable format
            })
            ->make(true);
    }

    public function exportDataInCSV($param)
    {
        switch ($param) {
            case 'all':
                return Excel::download(new AssignmentExport("all"), 'ALL ASSIGNMENT.csv');
                break;

            case 'author':
                return Excel::download(new AssignmentExport("author"), 'AUTHOR ASSIGNMENT.csv');
                break;

            case 'title':
                return Excel::download(new AssignmentExport("title"), 'TITLE ASSIGNMENT.csv');
                break;
        }
    }

        public function exportDataInXML($param){
        $file_name = '';
            switch ($param) {
                case 'all-data':
                    $records = Assignment::getAllAssignmentData();
                    $param_type ='all';
                    $file_name ="BOOKS DATA.XML";
                    break;

                case 'author':
                    $param_type ='author';
                    $records = Assignment::getAuthor();
                    $file_name ="AUTHOR DATA.XML";
                    break;

                case 'title':
                    $param_type ='title';
                    $records = Assignment::getTitle();
                    $file_name ="TITLE DATA.XML";
                    break;
                }

            $content =view('xml.xml', compact('records','param_type'))->render();
            File::put(storage_path().'/'.'app'.'/public/'.$file_name, $content);
            $path = storage_path().'/'.'app'.'/public/'.$file_name;
            if (file_exists($path)) {
                return Response::download($path);
            }
        }

}
