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
        {{--<input type="hidden" id="role" value="{!! $data['role'] !!}">--}}

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <a id="register-button" class="general-action add" href=""><i class="fa fa-pencil"></i></a>
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

    <div id="register-modal" class="modal fade" data-backdrop="static" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" arial-lable="Close" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Register New SWAN</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="error"></div>
                <form action="" id="register">
                    <div class="form-group has-feedback">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Full Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="alias" id="alias" class="form-control" placeholder="Alias">
                        <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="repassword" id="repassword" class="form-control"
                               placeholder="Re-Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false"
                                         style="position: relative;">
                                        <input type="checkbox" name="agree-terms" id="agree-terms">
                                    </div>
                                    I agree to the
                                    <a href="">terms</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" id="btn-register" class="btn btn-block btn-primary btn-flat">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection