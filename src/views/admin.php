
<?php include "inc/header.php" ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php if($data['myprofile'] != 4) :?>
                    <img class="profile-user-img img-fluid" id="user-img" getid="<?= $id ?>" src=<?= assets("admin/dist/img/$avatar"); ?> alt="User profile picture">
                  <?php else : ?>
                  <a aria-label="oo" href="#" data-toggle="modal" data-target="#exampleModalCenter">
                    <img class="profile-user-img " id="user-img" getid="<?= $id ?>" src=<?= assets("admin/dist/img/$avatar"); ?> alt="User profile picture">
                  </a>
                  <?php endif ?>
                  <h3 class="profile-username"><?= $name ?></h3>
                  <p class="text-muted"><?= $job ?></p>
                </div>
                <?php 
                  if($data['myprofile'] == 4){
                ?>
                  <a aria-label="oo" class="btn btn-info d-block my-2" data-toggle="modal" data-target="#exampleModalCenterconfirmedfriends">friends <i class="fa fa-users " ></i></a>
                <?php
                  }else{
                ?>
                  <a aria-label="oo" class="btn btn-info d-block my-2 " id="addfriend" getid="<?= $id ?>" status="<?= $data['myprofile'] ?>"><span id="spantext">Add friend</span> <i class="fa fa-user"></i></a>
                <?php } ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong>
                  <i class="fas fa-book mr-1"></i>
                   Education
                  <?php 
                    if($data['myprofile'] == 4){
                  ?>
                  <span class="float-right">
                    <a><i class="fa fa-edit text-success" data-toggle="modal" data-target="#exampleModalCentereditabout"></i></a>
                                     
                   </span>
                  <?php 
                    }
                  ?>
                </strong>
                <p class="text-muted">
                <?= $educ ?>
                </p>

                <hr>

                <strong>
                  <i class="far fa-file-alt mr-1"></i> 
                  Description
                  <?php 
                    if($data['myprofile'] == 4){
                  ?>
                  <span class="float-right">
                    <a><i class="fa fa-edit text-success" data-toggle="modal" data-target="#exampleModalCentereditdisc"></i></a>            
                  </span>
                  <?php 
                    }
                  ?>
                </strong>
                <p class="text-muted"><?= $disc ?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9 " id="posts-container" count="<?=(isset($data['project_count'])) ? $data['project_count'] : 0 ?>">
          <?php if($data['myprofile'] == 4) :?>
            <div class="card-header p-2">
              <a aria-label="oo" href="#" class="btn btn-primary btn-block"  data-toggle="modal" data-target="#exampleModalCenteraddpost"><i class = "fa fa-plus"></i> New Projects</a>
            </div>
          <?php endif ?>
            <?php 
              if(!empty($data['posts'])) :
                foreach($data['posts'] as $post) :
            ?>
            <div class="card border border-5 border-dark">
              <div class="card-body">
                <div class="tab-content">
                  <div class="post border border-3 border-dark borfder-dark p-2">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src=<?= assets("admin/dist/img/".$post['user']['avatar']); ?> alt="user image">
                      <span class="username">
                        <a aria-label="oo" href="#">
                          <?= $post['user']['name'] ?>
                        </a>
                          <?php
                            if($data['myprofile'] == 4){
                          ?>
                          <!-- <i class="fas fa-times"></i> -->
                            <a aria-label="oo" class="float-right btn-tool" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-bars"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <a aria-label="oo" class="dropdown-item" href="/Profile/delPost/<?=$post['id']?>">Delete Post</a>
                            </div>
                            <?php } ?>
                      </span>
                      <span class="description"><?= $post['dateofpost'] ?></span>
                    </div>
                      <!-- /.user-block -->
                    <p class="mb-1">
                      <?= $post['disc'] ?>
                    </p>
                    <div class="row rounded p-2 mb-5">
                      <?php 
                        if(!empty($post['photos'])) :
                          foreach($post['photos'] as $photo) :
                      ?>
                        <img class="img-fluid col-md-4  p-2 border border-dark rounded" style="height:250px;" src=<?= assets("admin/dist/img/".$photo['photo']); ?> alt="Photo">
                      <?php 
                          endforeach;
                        endif;
                      ?>
                    </div>
                      <p>
                        <a aria-label="oo" class="likepost" postid="<?=$post['id']?>" class="text-sm"><i class="far fa-thumbs-up mr-1"></i> Like </a>
                        <a aria-label="oo" class="countlikepost text-secondary" data-toggle="modal" data-target="#exampleModalCenterlikes<?= $post['id'] ?>"><?= ( isset($post['likescount']) ) ? $post['likescount'] : "0" ?></a>
                        
                        <span class="float-right">
                          <a aria-label="oo" href="#" class="text-sm" data-toggle="modal" data-target="#exampleModalCentercomments<?= $post['id'] ?>">
                            <i class="far fa-comments mr-1"></i>
                            Comments (<span class="countomments"><?= ( isset($post['commentscount']) ) ? $post['commentscount'] : "0"  ?></span>)
                          </a>
                        </span>
                        <!-- Start Likes Pop Up Modal -->
                            <div class="modal fade" id="exampleModalCenterlikes<?=$post['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <div class="card">
                                      <div class="card-body">
                                        <div class="tab-content likecontainer">
                                          <div class="post">
                                          <?php 
                                            if(!empty($post['likes'])) :
                                              foreach($post['likes'] as $like) :
                                          ?>
                                              <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src=<?= assets("admin/dist/img/".$like['user']['avatar']); ?> alt="user image">
                                                <span class="username">
                                                  <a aria-label="oo" href="/Profile/index/<?= $like['user']['id'] ?>">
                                                    <?= $like['user']['name'] ?>
                                                  </a>
                                                  <a aria-label="oo" class="float-right btn-tool" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <<i class="far fa-thumbs-up mr-1"></i>
                                                  </a>
                                                </span>
                                                <span class="description"><?= $like['dateoflike'] ?></span>
                                              </div>
                                              <?php 
                                              endforeach;
                                            endif;
                                            ?>
                                            </div>
                                        </div>
                                        <!-- /.tab-content -->
                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!-- End Likes Pop Up Modal -->
                        <!-- Start Comments Pop Up Modal -->
                            <div class="modal fade" id="exampleModalCentercomments<?=$post['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <div class="card">
                                      <div class="card-body">
                                        <div class="tab-content commentcontainer">
                                          <?php 
                                            if(!empty($post['comments'])) :
                                              foreach($post['comments'] as $comment) :
                                          ?>
                                          <div class="post postcomment">
                                            <div class="user-block">
                                              <img class="img-circle img-bordered-sm" src=<?= assets("admin/dist/img/".$comment['user']['avatar']); ?> alt="user image">
                                              <span class="username">
                                                <a aria-label="oo" href="/Profile/index/<?= $comment['user']['id'] ?>">
                                                  <?= $comment['user']['name'] ?>
                                                </a>
                                                <?php if($comment['user']['id'] == $_SESSION['userId']) :?>
                                                <a aria-label="oo" class="float-right btn-tool" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-bars"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                  <a aria-label="oo" class="dropdown-item deletecomment" commentid="<?=$comment['id']?>">Delete comment</a>
                                                </div>
                                                <?php endif ?>
                                              </span>
                                              <span class="description"><?= $comment['dateofcomment'] ?></span>
                                            </div>
                                              <!-- /.user-block -->
                                            <p>
                                              <?= $comment['comment'] ?>
                                            </p>
                                          </div>
                                          <?php 
                                              endforeach;
                                            endif;
                                          ?>
                                        </div>
                                        <!-- /.tab-content -->
                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                  </div>
                                  <div class="modal-footer">
                                    <div class="input-group input-group-sm mb-0">
                                      <input class="form-control form-control-sm commentinp" type="text" name="comment" placeholder="Type a comment">
                                      <div class="input-group-append">
                                        <button type="button" postid="<?=$post['id']?>"  class="btn btn-danger comuntbtn">comment</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!-- End Comments Pop Up Modal -->
                      </p>
                    </div>
                  </div>
                  <!-- /.tab-content -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
                <?php 
                    endforeach;
                  endif;
                ?>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

</div>
<!-- ////////////////////Stsrt Modal///////////////////// -->

<?php if($data['myprofile'] == 4){ ?>
<!-- Stsrt User avatar Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form text-center" action="/Profile/editAvatr" method="post" style="margin-left:10px" enctype="multipart/form-data">
        <div class="modal-body text-center">
          <img class="profile-user-img img-fluid" src=<?= assets("admin/dist/img/$avatar"); ?> alt="User profile picture">
          <input type="file" style="margin:20px 0 20px 100px;border:none" name="img" >
        </div>
        <div class="modal-footer">
          <a aria-label="oo" href="/profile/delavatar" class="btn btn-danger text-light" >Delete</a>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End User avatar Modal -->


<!-- Start User edit education Pop Up Modal -->
<div class="modal fade" id="exampleModalCentereditabout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="form-horizontal" action="/Profile/editEduc" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">update education</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control" id="inputName" value="<?= $educ ?>" placeholder="Education" name="educat">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End User edit education Pop Up Modal -->

<!-- Start User edit discription Pop Up Modal -->
<div class="modal fade" id="exampleModalCentereditdisc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <form class="form-horizontal" action="/Profile/editDisc" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">update discription</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control" id="inputName" value="<?= $disc ?>" placeholder="discription" name="disc">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End User edit discription Pop Up Modal -->


<!-- Start add new projects Modal -->
<div class="modal fade" id="exampleModalCenteraddpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="form-horizontal" action="/Profile/addPost" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">update education</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="col-sm-12">
              <textarea class="form-control" id="inputName" name="disc" cols="30" rows="5"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End User edit education Pop Up Modal -->

<!-- Start confirmedfriends Pop Up Modal -->
<?php if(!empty($data['friends']['confirmed_friends'])) :?>
    <div class="modal fade" id="exampleModalCenterconfirmedfriends" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="card">
              <div class="card-body">
                <div class="tab-content">
                  <div class="post">
                  <?php 
                      foreach($data['friends']['confirmed_friends'] as $friends) :
                  ?>
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm mt-2" src=<?= assets("admin/dist/img/".$friends['avatar']); ?> alt="user image">
                        <span class="username mt-3">
                          <a aria-label="oo" href="/Profile/index/<?= $friends['id'] ?>">
                            <?= $friends['name'] ?>
                          </a>
                          <a aria-label="oo" class="float-right btn-tool" >
                            <i class="far fa-user mr-1 mt-3"></i>
                          </a>
                        </span>
                      </div>
                      <?php 
                      endforeach;
                    ?>
                    </div>
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
<?php endif ?>
<!-- End confirmedfriends Pop Up Modal -->

<!-- Start waitingfriends Pop Up Modal -->
<?php if(!empty($data['friends']['waitingfriends'])) :?>
    <div class="modal fade" id="exampleModalCenterwaitingfriends" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="card">
              <div class="card-body">
                <div class="tab-content">
                  <div class="post">
                    <?php 
                      foreach($data['friends']['waitingfriends'] as $friends) :
                    ?>
                      <div class="user-block confirmfriendcont">
                        <img class="img-circle img-bordered-sm mt-2" src=<?= assets("admin/dist/img/".$friends['avatar']); ?> alt="user image">
                        <span class="username mt-3">
                          <a aria-label="oo" href="/Profile/index/<?= $friends['id'] ?>">
                            <?= $friends['name'] ?>
                            <a aria-label="oo" class="float-right btn-tool confirmfriendbtn" friendid="<?= $friends['id'] ?>">
                              <i class="fa fa-user-plus text-primary mr-1" ></i>
                            </a>
                          </a>
                        </span>
                        <span class="description">
                          <?=$friends['job']?>
                        </span>
                      </div>
                    <?php 
                      endforeach;
                    ?>
                    </div>
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
<?php endif ?>
<!-- End waitingfriends Pop Up Modal -->
<?php } ?>
<!-- ////////////////////End Modal///////////////////// -->

<?php include "inc/footer.php" ?>

