@extends('layouts.admin_master')

@section('content')
    <section class="content-header clear-float">
        <ol class="breadcrumb">
            <li><a href="/users"><i class="fa fa-users"></i> Users</a></li>
            <li class="active">List</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <table id="users-table">
                        <thead>
                            <th>#</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection