<?xml version="1.0" encoding="UTF-8"?>
<documents>
@foreach($records as $key=>$book)
    <assignment>
        @if($param_type == "all")
                <title>{{$book->title}}</title>
                <author_name>{{$book->author_name}}</author_name>
        @elseif($param_type == "author")
                <author_name>{{$book->author_name}}</author_name>

        @elseif($param_type =="title")
            <title>{{$book->title}}</title>
          @endif
    </assignment>
@endforeach
</documents>
