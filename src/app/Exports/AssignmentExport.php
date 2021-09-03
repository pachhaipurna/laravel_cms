<?php

namespace App\Exports;
use App\Models\Assignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class AssignmentExport implements FromCollection,WithHeadings
{
    /**
     * @var string
     */
    private $param;

    public function __construct(string $param)
    {
     $this->param= $param;
    }

    public function headings():array
    {
        if($this->param == "all") {
            return [
                "Book Title",
                "Book Author"
            ];
        }
        elseif ($this->param == "author"){
            return [
                "Book Author"
            ];
        }
        elseif($this->param == "title"){
            return [
                "Book Title"
            ];
        }
        else{
            return [];
        }

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->param =="all"){
            return collect(Assignment::getAllAssignmentData());
        }
        elseif ($this->param =="author"){
            return collect(Assignment::getAuthor());
        }
        elseif($this->param =="title"){
            return collect(Assignment::getTitle());
        }

    }

}
