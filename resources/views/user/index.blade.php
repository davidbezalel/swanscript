@extends('layouts.admin_master')

@section('content')
    <section class="content-header clear-float">
        <ol class="breadcrumb">
            <li><a href="/users"><i class="fa fa-users"></i> Users</a></li>
            <li class="active">List</li>
        </ol>
    </section>

    <section class="content">
        <input type="hidden" id="id" value="{!! Auth::user()->id !!}">
        <input type="hidden" id="role" value="{!! Auth::user()->role !!}">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <table id="users-table">
                            <thead>
                            <tr>
                                <th class="no">#</th>
                                <th>Name</th>
                                <th>Alias</th>
                                <th>Email</th>
                                <th>Avatar</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection