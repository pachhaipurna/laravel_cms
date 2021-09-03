@extends('layouts.master')
@section('title')
    Web assignment list
@stop
@section('content')

    <div class="col-md-12" style="margin-top: 20px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('assignment_dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('books_list')}}">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>
    <div class="row" id="filter_div">
        <div class="col-md-8" id="custom_filter">

        </div>
        <div class="col-md-4" id="custom_filter">
            <h2 class="text-right pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-flat">Export in CSV</button>
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown"
                            aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">

                        <a class="dropdown-item" href="{{route('csv_export_data','all')}}">Title & Author</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('csv_export_data','title')}}">Titles</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('csv_export_data','author')}}">Authors</a>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-flat">Export in XML</button>
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown"
                            aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">

                        <a class="dropdown-item" href="{{route('xml_export_data','all-data')}}">Title & Author</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('xml_export_data','title')}}">Titles</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('xml_export_data','author')}}">Authors</a>
                    </div>
                </div>
                <a class="btn bg-olive btn-flat margin" href="{{route('create_book')}}">Add New Book
                </a>
            </h2>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <table id="laravel_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Book Title</th>
                            <th>Author Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @include('partials.footer_scripts')
    <script>
        $(document).ready(function () {
            $('#laravel_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('books_list') }}",
                columns: [
                    {
                        data: "id",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1 + '.';
                        }
                    },
                    {data: 'title', name: 'title'},
                    {data: 'author_name', name: 'author_name'},
                    {data: 'created_at', name: 'created_at'},

                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (val, type, data) {

                            return '<a href="{{url('web-assignment/edit',null)}}/' + data.id + '" class="btn btn-default btn-flat" data-rel ="tooltip" title="Edit book." style="margin-right: 3px">' +
                                '<i class="fas fa-edit"></i></button></a>' +
                                '<a href="{{url('web-assignment/delete',null)}}/' + data.id + '" data-action ="delete" data-toggle="modal" data-target="delete" class="btn btn-danger btn-flat" data-rel ="tooltip" title="Delete book.">' +
                                '<i class="fas fa-trash"></i></button></a>'
                                ;
                        }
                    }
                ]
            });
        });
    </script>
@stop
