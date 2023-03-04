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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                       

                    </div>
                    <div class="col-4 offset-8">
                        @if (session('createSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-regular fa-circle-check"></i><strong> {{ session('createSuccess')}}</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif 
                        @if (session('deleteSuccess'))
                            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                <i class="fa-solid fa-circle-xmark"></i><strong> {{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key: <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#list') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="search"
                                        value="{{ request('key') }}">
                                    <button class="btn btn-dark" type="submit"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-1 offset-10 py-3 bg-light text-center shadow-sm">
                            <h4><i class="fa-solid fa-database me-2"></i> {{$admin->total()}}</h4>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    
                                    <tr class="tr-shadow ">
                                        
                                       
                                        <td class="col-2">
                                            @if ($a->image == null)
                                                @if ($a->gender == 'male')
                                                    <img src="{{ asset('image/default_user.png') }}"
                                                        class="image-thumbnail shadow-sm">
                                                @elseif ($a->gender == 'female')
                                                    <img src="{{ asset('image/female_default.png') }}"
                                                        class="image-thumbnail shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}"
                                                    class="image-thumbnail shadow-sm">
                                            @endif
                                        </td>
                                        
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <input type="hidden" id="userId" value="{{$a->id}}">
                                        
                                        <td>
                                            <select class="form-control accountRole" id="accountRole">
                                                <option @if ($a->role == 'admin')
                                                    selected
                                                @endif value="admin">Admin</option>
                                                <option @if ($a->role == 'user')
                                                    selected
                                                @endif value="user">User</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                <a href="{{ route('admin#changeRole', $a->id) }}" class="me-1">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Change">
                                                        <i class="fa-solid fa-arrows-rotate"></i></i>
                                                    </button>

                                                </a>
                                                    <a href="{{ route('admin#delete', $a->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>

                                                    </a>
                                                @endif

                                            </div>
                                        </td>
                    </div>
                    </tr>
                    @endforeach




                    </tbody>
                    </table>
                    <div class="mt-3">
                        {{$admin->links()}}
                       
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
            


           $('.accountRole').change(function(){
            $parentNode = $(this).parents('tr');
            // $currentName = $parentNode.find('.namee').html();
            $userId = $parentNode.find('#userId').val();
            $currentRole = $(this).val();
            $data = {
                'role' : $currentRole,
                'userId' : $userId
            }
            
            
            $.ajax({
                type: "get",
                url: "/admin/change/adminToUser",
                data: $data,
                dataType: "json",
                
            });
            location.reload();
            
           })
         });
    </script>
@endsection
