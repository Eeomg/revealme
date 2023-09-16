
<?php include "inc/header.php" ?>
 
    <!-- Main content -->
    <section class="content" >
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8" id="posts-container" count="<?=(isset($data['count']))?$data['count']:0?>">
            <?php 
              if(isset($data['projects'])) :
                foreach($data['projects'] as $post) :
            ?>
            <!-- Post -->
            <div class="card border border-5 border-dark">
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane " id="activity">
                    <div class="post p-2 ">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src=<?= assets("admin/dist/img/".$post['user']['avatar']); ?> alt="user image">
                        <span class="username">
                          <a href="/profile/index/<?= $post['user']['id'] ?>"><?= $post['user']['name'] ?></a>
                          <a href="#" class="float-right btn-tool">
                            <i class="fas fa-times"></i>
                          </a>
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
                          <img class="img-fluid col-sm-4 p-2 border border-dark rounded" style="height: 250px;" src=<?= assets("admin/dist/img/".$photo['photo']); ?> alt="Photo">
                        <?php 
                            endforeach;
                          endif;
                        ?>
                      </div>
                      <p>
                        <a class="likepost text-sm" postid="<?=$post['id']?>" >
                        <i class="far fa-thumbs-up mr-1"></i> 
                          Like 
                        </a>
                        <a class="countlikepost text-secondary" data-toggle="modal" data-target="#exampleModalCenterlikes<?= $post['id'] ?>"><?= ( isset($post['likescount']) ) ? $post['likescount'] : "0" ?></a>
                        
                        <span class="float-right">
                          <a href="#" class="text-sm" data-toggle="modal" data-target="#exampleModalCentercomments<?= $post['id'] ?>">
                            <i class="far fa-comments mr-1"></i>  Comments (<span class="countomments"><?= ( isset($post['commentscount']) ) ? $post['commentscount'] : "0"  ?></span>)
                          </a>
                        </span>

                        <!-- like pop up modal -->
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
                                            <img class="img-circle img-bordered-sm" src=<?= assets("admin/dist/img/".$like['user']['avatar']) ?> alt="user image">
                                            <span class="username">
                                              <a href="/Profile/index/<?= $like['user']['id'] ?>">
                                                <?= $like['user']['name'] ?>
                                              </a>
                                              <a class="float-right btn-tool" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                        <!-- commet pop up modal -->
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
                                            <a href="/Profile/index/<?=$comment['user']['id']?>">
                                              <?= $comment['user']['name'] ?>
                                            </a>
                                            <?php if($comment['user']['id'] == $_SESSION['userId']) :?>
                                            <a class="float-right btn-tool" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="fas fa-bars"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                              <a class="dropdown-item deletecomment" commentid="<?=$comment['id']?>">Delete comment</a>
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
                      </p>
                    </div>
                    <!-- /.post -->
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
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<!-- Start Comments Pop Up Modal -->
<?php 
  if(!empty($data['projects'])) :
    foreach($data['projects'] as $post) :
?>

    <?php 
        endforeach;
      endif;
    ?>
<!-- End Comments Pop Up Modal -->

<!-- Start Likes Pop Up Modal -->
<?php 
  if(!empty($data['projects'])) :
    foreach($data['projects'] as $post) :
?>
    <?php 
        endforeach;
      endif;
    ?>
<!-- End Likes Pop Up Modal -->
<!-- ./wrapper -->
<?php include "inc/footer.php" ?>

