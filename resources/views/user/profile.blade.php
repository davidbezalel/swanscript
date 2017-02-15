@extends('layouts.admin_master')

@section('content')
    <section class="content-header clear-float">
        <ol class="breadcrumb">
            <li><a href="/users"><i class="fa fa-dashboard"></i> Users</a></li>
            <li class="active">User profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-info">
                    <div class="box-body box-profile">
                        <input type="hidden" id="id" value="{!! $data['id'] !!}">
                        <div class="photo-blur-container" id="upload-image-container">
                            <img id="img-result" class="profile-user-img img-responsive img-circle" src="/images/user/user_avatar.png">
                            <div class="photo-blur-front">
                            </div>
                        </div>
                        <p class="label label-danger label-block" id="error-update-image"></p>
                        <input type="file" id="user-image" name="photo" style="display: none">
                        </form>
                        <h3 class="user_name profile-username text-center"></h3>
                        <p class="text-muted text-center user_alias_email"></p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                        <p class="education text-muted"></p>
                        <hr>
                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                        <p class="location text-muted"></p>
                        <hr>
                        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
                        <p class="skills">
                        </p>
                        <hr>
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                        <p class="notes text-muted"></p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li><a href="#profile" data-toggle="tab">Profile</a></li>
                        <li><a href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- /.tab-pane -->
                        <div class="active tab-pane" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                        <div class="timeline-body">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                            quora plaxo ideeli hulu weebly balihoo...
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-primary btn-xs">Read more</a>
                                            <a class="btn btn-danger btn-xs">Delete</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-user bg-aqua"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                        </h3>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-comments bg-yellow"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-camera bg-purple"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                        <div class="timeline-body">
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="profile">
                            <form action="" id="update_profile" class="form-horizontal">
                                <input type="hidden" id="id" name="id" value="{!! $data['id'] !!}">
                                <input type="hidden" id="flag" name="flag" value="1">
                                <div class="alert alert-success" id="update_profile_success"></div>
                                <div class="form-group">
                                    <label for="inputEducation" class="col-sm-2 control-label">Education</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="education" class="form-control" id="inputEducation" placeholder="Education">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputLocation" class="col-sm-2 control-label">Location</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="location" class="form-control" id="inputLocation" placeholder="Location">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="skills" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNotes" class="col-sm-2 control-label">Notes</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="notes" id="inputNotes" placeholder="Notes"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="settings">
                            <form action="" id="update_setting" class="form-horizontal">
                                <input type="hidden" id="id" name="id" value="{!! $data['id'] !!}">
                                <input type="hidden" id="flag" name="flag" value="2">
                                <div class="alert alert-success" id="update_setting_success"></div>
                                <div class="alert alert-danger" id="update_setting_error"></div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAlias" class="col-sm-2 control-label">Alias</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="alias" class="form-control" id="inputAlias" placeholder="Alias">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
@endsection