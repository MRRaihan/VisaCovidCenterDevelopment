@extends('SuperAdmin.layouts.master')

@push('title')
    Slider List
@endpush


@section('content')
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">All Slider</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{route('superAdmin.dashboard')}}">Dashboard</a></li>
                            <li class="active">All Slider</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row m-b-15">
                <div class="col-sm-12">
                    <a class="btn btn-primary" href="{{route('superAdmin.slider.create')}}"><i class="fa fa-plus"></i> Create New Slider</a>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">All Slider Table</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($sliders as $slider)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$slider->title}}</td>
                                                <td><img src="{{asset($slider->image)}}" alt="category Image" style="width: 110px;"></td>
                                                <td><span class="label {{$slider->status ? 'label-success':'label-warning'}}">{{$slider->status ? 'Active':'Inactive'}}</span></td>
                                                <td>
                                                    <a href="{{route('superAdmin.slider.edit', $slider->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                    <button class="btn btn-danger" onclick="delete_function(this)" value="{{ route('superAdmin.slider.destroy', $slider) }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('script')
@endpush
