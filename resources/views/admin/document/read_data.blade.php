        @extends('admin_layout')
        @section('admin_content')

            <div class="table-agile-info">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Liệt kê Document
                    </div>

                   
                        @foreach ($contents as $value)

                            <li>Name : {{ $value['name'] }}</li>
                            <li>Path : {{ $value['path'] }}</li>
                            <li>Basename : {{ $value['basename'] }}</li>
                            <li>Mimetype : {{ $value['mimetype'] }}</li>
                            <li>Type : {{ $value['type'] }}</li>
                            <li>Mimetype : {{ $value['size'] }}</li>

                            <li>Download file cách 1 : <a href="https://drive.google.com/file/d/{{ $value['path'] }}/view"
                                    target="_blank">Tải</a></li>

                            <li>Download file cách 2 : <a
                                    href="{{ url('download_document', ['path' => $value['path'], 'name' => $value['name']]) }}">Tải</a>
                            </li>

                            <li>Delete : <a href="{{ url('delete_document', ['path' => $value['path']]) }}">Delete</a></li>

                            <iframe src="https://drive.google.com/file/d/{{ $value['path'] }}/preview" style="pointer-events: none" width="250" height="250" allow="autoplay"></iframe>
                        @endforeach
                  

                    </div>

                
            </div>

        @endsection
