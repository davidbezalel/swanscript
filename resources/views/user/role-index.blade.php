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
        <input type="hidden" id="is_permitted" value="<?php echo($data['is_permitted']); ?>">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <?php
                        if ($data['is_permitted']) {
                            echo('<a id="add" class="general-action add" href=""><i class="fa fa-pencil"></i></a>
                                   <a id="multiple-delete" class="general-action multiple-delete" href=""><i class="fa fa-trash-o"></i></a>');
                        }
                        ?>
                        <table id="table">
                            <thead>
                            <tr>
                                <?php
                                if ($data['is_permitted']) {
                                    echo ('<th class="no"></th>');
                                }
                                ?>
                                <th class="no">#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <?php
                                if ($data['is_permitted']) {
                                    echo('
                                            <th>Profile</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                    ');
                                }
                                ?>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="add-modal" class="modal fade" data-backdrop="static" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" id="add-form">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" arial-lable="Close" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="error"></div>
                    <div class="form-group has-feedback">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="description" id="description" class="form-control"
                               placeholder="Description">
                        <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-add-role" class="btn btn-block btn-primary btn-flat">Add</button>
                </div>
            </form>

        </div>
    </div>

    <div id="update-modal" class="modal fade" data-backdrop="static" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" id="update-form">
                <input type="hidden" id="id" name="id">

                <div class="modal-header">
                    <button class="close" data-dismiss="modal" arial-lable="Close" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="error"></div>
                    <div class="form-group has-feedback">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="description" id="description" class="form-control"
                               placeholder="Description">
                        <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-add-role" class="btn btn-block btn-primary btn-flat">Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection