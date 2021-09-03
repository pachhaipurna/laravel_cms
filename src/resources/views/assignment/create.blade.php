@extends('layouts.master')
@section('title')
    Create new book
@stop
@section('content')
    <div class="col-md-12" style="margin-top: 20px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('assignment_dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('books_list')}}">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>

    <div class="row" id="filter_div">
        <div class="col-md-8" id="custom_filter">
            <h4 class="text-left pull-left">
                Add book
            </h4>
        </div>
        <div class="col-md-4" id="custom_filter">
            <h2 class="text-right pull-right">
                <a class="btn bg-olive btn-flat margin"  href="{{route('books_list')}}">Books List
                </a>
            </h2>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">

                        <form action="{{route('save_book')}}" method="POST">
                            {!! csrf_field() !!}
                            <div class="card-body">
                                <div class="form-group {{ ($errors->has('title'))?'has-error':'' }}">
                                    <label for="title">Book Title <strong style="color: red;font-size: 20px">*</strong>
                                    </label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Enter book title." value="{{old('title')}}">
                                    @if ($errors->has('title'))
                                        <span class="help-block" style="color: red">
                                        <strong>  {{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ ($errors->has('author_name'))?'has-error':'' }}">
                                    <label for="author_name">Author Name<strong
                                            style="color: red;font-size: 20px">*</strong> </label>
                                    <input type="text" class="form-control" name="author_name" id="author_name"
                                           placeholder="Enter author name." value="{{old('author_name')}}">
                                    @if ($errors->has('author_name'))
                                        <span class="help-block" style="color: red">
                                        <strong>  {{ $errors->first('author_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                                <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

