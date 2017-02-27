@extends('layouts.admin_master')

@section('content')
    <section class="content-header clear-float">
        <ol class="breadcrumb">
            <li><a href="/users"><i class="fa fa-users"></i> Users</a></li>
            <li class="active">Roles</li>
        </ol>
    </section>

    <section class="content">
        <input type="hidden" id="id" value="{!! Auth::user()->id !!}">
        <input type="hidden" id="role" value="{!! Auth::user()->role !!}">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <a id="add-role" class="general-action" href=""><i class="fa fa-pencil-square"></i></a>
                        <table id="roles-table">
                            <thead>
                            <tr>
                                <th class="no">#</th>
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="add-modal" class="modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" arial-lable="Close" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Add New User Role</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="error"></div>
                <form action="" id="addrole">
                    <div class="form-group has-feedback">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                        <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-offset-10 col-xs-2">
                            <button type="submit" id="btn-add-role" class="btn btn-block btn-primary btn-flat">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection