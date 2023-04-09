@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.user.pages.profile.title')}}
@endsection

@section('center_page')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-body profile-page p-0">
                    <div class="profile-header">
                        <div class="cover-container">
                            <img src="{{asset('assets/images/profile-bg.jpg')}}" alt="profile-bg"
                                 class="rounded img-fluid">
                        </div>
                        <div class="profile-info p-4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="user-detail pl-5">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <div class="profile-img pr-4">
                                                <img width="100px" height="100px"
                                                     src="{{Auth::user()->picture==null?asset('assets/images/guest.png'):asset('assets/images/users/'.Auth::user()->picture)}}"
                                                     alt="profile-img"
                                                     class="avatar-130 img-fluid"/>
                                            </div>
                                            <div class="profile-detail d-flex align-items-center">
                                                <h3>{{Auth::user()->last_name.' '.Auth::user()->first_name}}</h3>
                                                <p class="m-0 pl-3"> -
                                                    @if(auth()->user()->roles->pluck('name')[0]=='super_admin')
                                                        {{__('labels.rules.super')}}
                                                    @else
                                                        {{__('labels.rules.admin')}}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <ul class="nav nav-pills d-flex align-items-end float-right profile-feed-items p-0 m-0">
                                        <li>
                                            <a class="nav-link active" data-toggle="pill" href="#profile-feed">feed</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="pill" href="#profile-activity">Activity</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="pill" href="#profile-friends">friends</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="pill" href="#profile-profile">profile</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-9 profile-center">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="profile-feed" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-body p-0">
                                    <div class="user-post-data p-3">
                                        <div class="d-flex flex-wrap">
                                            <div class="media-support-user-img mr-3">
                                                <img class="rounded-circle img-fluid" src="images/user/01.jpg" alt="">
                                            </div>
                                            <div class="media-support-info mt-2">
                                                <h5 class="mb-0"><a href="#" class="">Anna Sthesia</a></h5>
                                                <p class="mb-0 text-primary">colleages</p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton52"
                                                         data-toggle="dropdown">
                                                      <a href="#" class="text-secondary">29 mins <i
                                                              class="ri-more-2-line ml-3"></i></a>
                                                   </span>
                                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-share-forward-line mr-2"></i>Share</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-file-copy-line mr-2"></i>Copy Link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-post">
                                        <a href="javascript:void(0);"><img src="images/page-img/p1.jpg" alt="post-image"
                                                                          class="img-fluid"/></a>
                                    </div>
                                    <div class="comment-area p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center feather-icon mr-3">
                                                    <a href="javascript:void(0);"><i class="ri-heart-line"></i></a>
                                                    <span class="ml-1">140</span>
                                                </div>
                                                <div class="d-flex align-items-center message-icon">
                                                    <a href="javascript:void(0);"><i class="ri-chat-4-line"></i></a>
                                                    <span class="ml-1">140</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="iq-media-group">
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/05.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/06.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/07.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/08.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/09.jpg" alt="">
                                                    </a>
                                                </div>
                                                <span class="ml-2">+140 more</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor,
                                            ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra.
                                            Proin blandit ac massa sed rhoncus</p>
                                        <hr>
                                        <ul class="post-comments p-0 m-0">
                                            <li class="mb-2">
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-img">
                                                        <img src="images/user/02.jpg" alt="userimg"
                                                             class="avatar-35 rounded-circle img-fluid">
                                                    </div>
                                                    <div class="comment-data-block ml-3">
                                                        <h6>Monty Carlo</h6>
                                                        <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                        <div
                                                            class="d-flex flex-wrap align-items-center comment-activity">
                                                            <a href="javascript:void(0);">like</a>
                                                            <a href="javascript:void(0);">reply</a>
                                                            <a href="javascript:void(0);">translate</a>
                                                            <span> 5 minit </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-img">
                                                        <img src="images/user/03.jpg" alt="userimg"
                                                             class="avatar-35 rounded-circle img-fluid">
                                                    </div>
                                                    <div class="comment-data-block ml-3">
                                                        <h6>Paul Molive</h6>
                                                        <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                        <div
                                                            class="d-flex flex-wrap align-items-center comment-activity">
                                                            <a href="javascript:void(0);">like</a>
                                                            <a href="javascript:void(0);">reply</a>
                                                            <a href="javascript:void(0);">translate</a>
                                                            <span> 5 minit </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <form class="comment-text d-flex align-items-center mt-3"
                                              action="javascript:void(0);">
                                            <input type="text" class="form-control rounded" placeholder="Lovely!">
                                            <div class="comment-attagement d-flex">
                                                <a href="javascript:void(0);"><i class="ri-user-smile-line mr-2"></i></a>
                                                <a href="javascript:void(0);"><i class="ri-camera-line mr-2"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="iq-card">
                                <div class="iq-card-body p-0">
                                    <div class="user-post-data p-3">
                                        <div class="d-flex flex-wrap">
                                            <div class="media-support-user-img mr-3">
                                                <img class="rounded-circle img-fluid" src="images/user/02.jpg" alt="">
                                            </div>
                                            <div class="media-support-info mt-2">
                                                <h5 class="mb-0"><a href="#" class="">jenny issad</a></h5>
                                                <p class="mb-0 text-primary">colleages</p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton53"
                                                         data-toggle="dropdown">
                                                      <a href="#" class="text-secondary">1 hr <i
                                                              class="ri-more-2-line ml-3"></i></a>
                                                   </span>
                                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-share-forward-line mr-2"></i>Share</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-file-copy-line mr-2"></i>Copy Link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0">
                                    <p class="p-3 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
                                        nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis
                                        pharetra. Proin blandit ac massa sed rhoncus</p>

                                    <div class="comment-area p-3">
                                        <hr class="mt-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center feather-icon mr-3">
                                                    <a id="clickme" href="javascript:void(0);"><i
                                                            class="ri-heart-line"></i></a>
                                                    <span class="ml-1">140</span>
                                                </div>
                                                <div class="d-flex align-items-center message-icon">
                                                    <a href="javascript:void(0);"><i class="ri-chat-4-line"></i></a>
                                                    <span class="ml-1">140</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="iq-media-group">
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/05.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/06.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/07.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/08.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/09.jpg" alt="">
                                                    </a>
                                                </div>
                                                <span class="ml-2">+140 more</span>
                                            </div>
                                        </div>
                                        <form class="comment-text d-flex align-items-center mt-3"
                                              action="javascript:void(0);">
                                            <input type="text" class="form-control rounded" placeholder="Lovely!">
                                            <div class="comment-attagement d-flex">
                                                <a href="javascript:void(0);"><i class="ri-user-smile-line mr-2"></i></a>
                                                <a href="javascript:void(0);"><i class="ri-camera-line mr-2"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-activity" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Activity timeline</h4>
                                    </div>
                                    <div class="iq-card-header-toolbar d-flex align-items-center">
                                        <div class="dropdown">
                                             <span class="dropdown-toggle text-primary" id="dropdownMenuButton5"
                                                   data-toggle="dropdown">
                                             View All
                                             </span>
                                            <div class="dropdown-menu dropdown-menu-right p-0">
                                                <a class="dropdown-item" href="#"><i
                                                        class="ri-user-unfollow-line mr-2"></i>View</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="ri-close-circle-line mr-2"></i>Delete</a>
                                                <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                                <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="ri-file-download-fill mr-2"></i>Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <ul class="iq-timeline">
                                        <li>
                                            <div class="timeline-dots"></div>
                                            <h6 class="float-left mb-1">Client Login</h6>
                                            <small class="float-right mt-1">24 November 2019</small>
                                            <div class="d-inline-block w-100">
                                                <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-dots border-success"></div>
                                            <h6 class="float-left mb-1">Scheduled Maintenance</h6>
                                            <small class="float-right mt-1">23 November 2019</small>
                                            <div class="d-inline-block w-100">
                                                <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-dots border-danger"></div>
                                            <h6 class="float-left mb-1">Dev Meetup</h6>
                                            <small class="float-right mt-1">20 November 2019</small>
                                            <div class="d-inline-block w-100">
                                                <p>Bonbon macaroon jelly beans <a href="#">gummi bears</a>gummi bears
                                                    jelly lollipop apple</p>
                                                <div class="iq-media-group">
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/05.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/06.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/07.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/08.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/09.jpg" alt="">
                                                    </a>
                                                    <a href="#" class="iq-media">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                             src="images/user/10.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-dots border-primary"></div>
                                            <h6 class="float-left mb-1">Client Call</h6>
                                            <small class="float-right mt-1">19 November 2019</small>
                                            <div class="d-inline-block w-100">
                                                <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-dots border-warning"></div>
                                            <h6 class="float-left mb-1">Mega event</h6>
                                            <small class="float-right mt-1">15 November 2019</small>
                                            <div class="d-inline-block w-100">
                                                <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-friends" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Friends</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <ul class="suggestions-lists m-0 p-0">
                                        <li class="d-flex mb-4 align-items-center">
                                            <div class="user-img img-fluid"><img src="images/user/01.jpg"
                                                                                 alt="story-img"
                                                                                 class="rounded-circle avatar-40"></div>
                                            <div class="media-support-info ml-3">
                                                <h6>Paul Molive</h6>
                                                <p class="mb-0">Web Designer</p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton41"
                                                         data-toggle="dropdown">
                                                      <i class="ri-more-2-line"></i>
                                                   </span>
                                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-close-circle-line mr-2"></i>Unfriend</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-lock-line mr-2"></i>block</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center">
                                            <div class="user-img img-fluid"><img src="images/user/01.jpg"
                                                                                 alt="story-img"
                                                                                 class="rounded-circle avatar-40"></div>
                                            <div class="media-support-info ml-3">
                                                <h6>Paul Molive</h6>
                                                <p class="mb-0">trainee</p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton42"
                                                         data-toggle="dropdown">
                                                   <i class="ri-more-2-line"></i>
                                                   </span>
                                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-close-circle-line mr-2"></i>Unfriend</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-lock-line mr-2"></i>block</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center">
                                            <div class="user-img img-fluid"><img src="images/user/02.jpg"
                                                                                 alt="story-img"
                                                                                 class="rounded-circle avatar-40"></div>
                                            <div class="media-support-info ml-3">
                                                <h6>Anna Mull</h6>
                                                <p class="mb-0">Web Developer</p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton43"
                                                         data-toggle="dropdown">
                                                   <i class="ri-more-2-line"></i>
                                                   </span>
                                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-close-circle-line mr-2"></i>Unfriend</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-lock-line mr-2"></i>block</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center">
                                            <div class="user-img img-fluid"><img src="images/user/03.jpg"
                                                                                 alt="story-img"
                                                                                 class="rounded-circle avatar-40"></div>
                                            <div class="media-support-info ml-3">
                                                <h6>Paige Turner</h6>
                                                <p class="mb-0">trainee</p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton54"
                                                         data-toggle="dropdown">
                                                   <i class="ri-more-2-line"></i>
                                                   </span>
                                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-close-circle-line mr-2"></i>Unfriend</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-lock-line mr-2"></i>block</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center">
                                            <div class="user-img img-fluid"><img src="images/user/04.jpg"
                                                                                 alt="story-img"
                                                                                 class="rounded-circle avatar-40"></div>
                                            <div class="media-support-info ml-3">
                                                <h6>Barb Ackue</h6>
                                                <p class="mb-0">Web Designer</p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton44"
                                                         data-toggle="dropdown">
                                                   <i class="ri-more-2-line"></i>
                                                   </span>
                                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-close-circle-line mr-2"></i>Unfriend</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-lock-line mr-2"></i>block</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center">
                                            <div class="user-img img-fluid"><img src="images/user/05.jpg"
                                                                                 alt="story-img"
                                                                                 class="rounded-circle avatar-40"></div>
                                            <div class="media-support-info ml-3">
                                                <h6>Greta Life</h6>
                                                <p class="mb-0">Tester</p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton45"
                                                         data-toggle="dropdown">
                                                   <i class="ri-more-2-line"></i>
                                                   </span>
                                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-close-circle-line mr-2"></i>Unfriend</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-lock-line mr-2"></i>block</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center">
                                            <div class="user-img img-fluid"><img src="images/user/06.jpg"
                                                                                 alt="story-img"
                                                                                 class="rounded-circle avatar-40"></div>
                                            <div class="media-support-info ml-3">
                                                <h6>Ira Membrit</h6>
                                                <p class="mb-0">Android Developer</p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton46"
                                                         data-toggle="dropdown">
                                                   <i class="ri-more-2-line"></i>
                                                   </span>
                                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-close-circle-line mr-2"></i>Unfriend</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-lock-line mr-2"></i>block</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center">
                                            <div class="user-img img-fluid"><img src="images/user/07.jpg"
                                                                                 alt="story-img"
                                                                                 class="rounded-circle avatar-40"></div>
                                            <div class="media-support-info ml-3">
                                                <h6>Pete Sariya</h6>
                                                <p class="mb-0">Web Designer</p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton47"
                                                         data-toggle="dropdown">
                                                   <i class="ri-more-2-line"></i>
                                                   </span>
                                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-user-unfollow-line mr-2"></i>Unfollow</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-close-circle-line mr-2"></i>Unfriend</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="ri-lock-line mr-2"></i>block</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <a href="" class="btn btn-primary d-block"><i
                                            class="ri-add-line"></i> Load More</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-profile" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">{{__('labels.navbar.profile.show')}}</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="user-detail text-center">
                                        <div class="user-profile">
                                            <img width="100px" height="100px"
                                                 src="{{Auth::user()->picture==null?asset('assets/images/guest.png'):asset('assets/images/users/'.Auth::user()->picture)}}"
                                                 alt="profile-img"
                                                 class="avatar-130 img-fluid">
                                        </div>
                                        <div class="profile-detail mt-3">
                                            <h3 class="d-inline-block">{{Auth::user()->last_name.' '.Auth::user()->first_name}}</h3>
                                            <p class="d-inline-block pl-3"> -
                                                @if(auth()->user()->roles->pluck('name')[0]=='super_admin')
                                                    {{__('labels.rules.super')}}
                                                @else
                                                    {{__('labels.rules.admin')}}
                                                @endif
                                            </p>
                                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">About User</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="user-bio">
                                        <p>Tart I love sugar plum I love oat cake. Sweet roll caramels I love jujubes.
                                            Topping cake wafer.</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>Joined:</h6>
                                        <p>{{date_format(Auth::user()->created_at, 'Y-m-d H:i')}}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.user.attr.city')}}:</h6>
                                        <p>{{Auth::user()->city->name}}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.user.attr.email')}}:</h6>
                                        <p><a href="#"> {{Auth::user()->email}}</a></p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.user.attr.phone')}}:</h6>
                                        <p><a href="#">{{Auth::user()->phone}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 profile-right">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('labels.user.pages.profile.about')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="about-info m-0 p-0">
                                <div class="row">
                                    <div class="col-12"><p>Lorem ipsum dolor sit amet, contur adipiscing elit.</p></div>
                                    <div class="col-3">{{__('labels.user.attr.email')}}:</div>
                                    <div class="col-9"><a href="#"> {{Auth::user()->email}} </a></div>
                                    <div class="col-3">{{__('labels.user.attr.phone')}}:</div>
                                    <div class="col-9"><a href="#">{{Auth::user()->phone}}</a></div>
                                    <div class="col-3">{{__('labels.user.attr.city')}}:</div>
                                    <div class="col-9">{{Auth::user()->city->name}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
