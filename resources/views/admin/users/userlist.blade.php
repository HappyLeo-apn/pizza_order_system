@extends('admin.layouts.master')
@section('title', 'category list page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">User List</h2>

                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key: <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="search"
                                        value="">
                                    <button class="btn btn-dark" type="submit"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-1 offset-10 py-3 bg-light text-center shadow-sm">
                            <h4><i class="fa-solid fa-database me-2"></i> {{$users->total()}}</h4>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        {{-- @if (count($categories) != 0) --}}
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                    <tr>
                                        <td class="col-2">
                                            @if ($u->image == null)
                                                @if ($u->gender == 'male')
                                                    <img src="{{ asset('image/default_user.png') }}"
                                                        class="image-thumbnail shadow-sm">
                                                @elseif ($u->gender == 'female')
                                                    <img src="{{ asset('image/female_default.png') }}"
                                                        class="image-thumbnail shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $u->image) }}"
                                                    class="image-thumbnail shadow-sm">
                                            @endif
                                        </td>
                                        <input type="hidden" id="userId" value="{{$u->id}}">
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->gender }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->address }}</td>
                                        
                                        <td>
                                            <select id="" class="form-control changeRole">
                                                <option @if ($u->role == 'user') selected @endif value="user">
                                                    User</option>
                                                <option value="admin" @if ($u->role == 'admin') selected @endif>
                                                    Admin</option>
                                            </select>
                                        </td>
                                        <td><i class="fa-solid fa-trash fs-4 text-danger me-3 delete-btn"></i>
                                            <a href="{{route('admin#modifyUserPage', $u->id)}}">
                                            <i class="fa-solid fa-pen-to-square fs-4 edit-btn"></i>
                                            </a></td>
                                       
                                        
                                    </tr>
                                @endforeach




                            </tbody>
                        </table>
                        <div class="mt-3">

                            {{$users->links()}}
                        </div>

                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')
    <script>
        $(document).ready(function(){
        $('.changeRole').change(function(){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents('tr');
            $userId = $parentNode.find('#userId').val();
            
            $data = {
                'userId' : $userId,
                'role' : $currentStatus,
            };
            console.log($data);

            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/admin/user/change/role",
                data: $data,
                dataType: "json",
                success: function (response) {
                    
                }
            });
            location.reload();
        });
        $('.delete-btn').click(function(){
            console.log("remove");
            $currentStatus = $(this).val();
            $parentNode = $(this).parents('tr');
            $userId = $parentNode.find('#userId').val();
            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/admin/user/delete",
                data: {
                    'userId' : $userId,
                },
                dataType: "json",
                
            });
            $parentNode.remove();
        })
        // $('.edit-btn').click(function(){
            
        //     $currentStatus = $(this).val();
        //     $parentNode = $(this).parents('tr');
        //     $userId = $parentNode.find('#userId').val();
        //     $.ajax({
        //         type: "get",
        //         url: "http://127.0.0.1:8000/admin/user/modifyPage",
        //         data: {
        //             'userId' : $userId,
        //         },
        //         dataType: "json",
                
        //     });

        // })
    });
    </script>
@endsection