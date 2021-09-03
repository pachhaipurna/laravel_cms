<?php

namespace App\Http\Controllers\Assignment;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentStoreRequest;
use App\Http\Requests\AssignmentUpdateRequest;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\Request;
use App\Models\Assignment;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
class AssignmentController extends Controller
{
    /**
     * @var Assignment
     */
    private $assignment;
    /**
     * @var AssignmentRepository
     */
    private $assignmentRepository;

    public function __construct(Assignment $assignment,
                                AssignmentRepository $assignmentRepository)
    {
        $this->assignment =$assignment;
        $this->assignmentRepository = $assignmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->assignmentRepository->datatables();
        }
        return view('assignment.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('assignment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AssignmentStoreRequest $request
     * @return Response
     */
    public function store(AssignmentStoreRequest $request)
    {
        $input = $request->all();
        try {
            $this->assignment->create($input);
            return redirect()
                ->route('books_list')
                ->with('success', Lang::get('assignment.success.create'));

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', Lang::get('assignment.error.create'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $book_id =(int)$id;
        $book = $this->assignment->find($book_id);
        return $book ? view('assignment.edit', compact('book')) : abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param AssignmentUpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update(AssignmentUpdateRequest $request, $id)
    {
        try{
            $book = $this->assignment->find($id);
            $book->update($request->all());
            return redirect()
                ->route('books_list')
                ->with('success', Lang::get('assignment.success.update'));
        }catch (\Exception $e){
            return redirect()
                ->back()
                ->withInput()
                ->with('error', Lang::get('assignment.error.update'));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try{
            $id =(int)$id;
            $book= $this->assignment->find($id);
            $book->delete();
            return redirect()
                ->route('books_list')
                ->with('success', Lang::get('assignment.success.delete'));

        }catch (\Exception $e){
            return redirect()
                ->back()
                ->with('error', Lang::get('assignment.error.delete'));
            }

    }

    /**
     * @param $url_param
     * @return \Illuminate\Http\RedirectResponse
     */
    public function exportInCSV($url_param)
    {
        try{
           $output=  $this->assignmentRepository->exportDataInCSV($url_param);
            return  $output;

        }catch (\Exception $e){
            return redirect()
                ->back()
                ->with('error', Lang::get('assignment.error.not_found'));
        }
    }

    /**
     * @param $url_parameter
     * @return Response
     */
    public function exportInXML($url_parameter)
    {
        try{
            $output=  $this->assignmentRepository->exportDataInXML($url_parameter);
            return  $output;
        }catch (\Exception $e){
            return redirect()
                ->back()
                ->with('error', Lang::get('assignment.error.not_found'));
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', Lang::get('assignment.error.not_found'));
        }
    }
}
