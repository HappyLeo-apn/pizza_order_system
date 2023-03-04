@extends('admin.layouts.master')

@section('content')
   <div class="container mt-5 p-5">
        <h3 class="mt-3 btn btn-primary offset-11 fs-bold">Inbox<span class="badge badge-light ms-2">{{$contactMessages->total()}}</span></h3>
        <table class="table text-center mt-5 mb-3">
            <thead>
               <tr class="bg-dark text-white"> 
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th></th></tr>
            </thead>
            <tbody>
                @foreach ($contactMessages as $cm)
                    <tr class="bg-light">
                        <input type="hidden" name="" id="messageID" value="{{$cm->id}}">
                        <td class="fw-bold text-primary">{{$cm->name}}</td>
                        <td>{{$cm->email}}</td>
                        <td class="text-dark text-center col-7">{{$cm->message}}</td>
                        <td class="text-danger">
                            <button class="text-danger fs-4 btn-remove" id="deleteButton"><i class="fa-solid fa-trash"></i></button>    
                        </td>    
                    </tr> 
                    
                @endforeach
            </tbody>
        </table>
        <div>
            {{$contactMessages->links()}}
        </div>
   </div>
@endsection
@section('scriptSection')
    <script>
        $(document).ready(function(){
            $('.btn-remove').click(function(){
                
                $parentNode = $(this).parents('tr');
                $messageID = $parentNode.find('#messageID').val();
                
               $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/admin/message/remove",
                data: {
                    'messageID' : $messageID,
                },
                dataType: "json",
                
               });
                $parentNode.remove();
            });
        })
    </script>
@endsection