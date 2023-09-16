
<?php include "inc/header.php" ?>
      <!-- Main content -->
<section class="content">
  <div class="container ">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-12">
        <div class="card">
        <?php 
          if(!empty($error)){
        ?>
        <div class="alert alert-warning opacity-0">
          <?=$error?>
        </div>
        <?php } ?>
          <div class="card-body row">
            <div class="col-md-4">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                  src=<?= assets("admin/dist/img/$avatar"); ?>
                  alt="User profile picture">
              </div>
              <h3 class="profile-username text-center"><?= $name ?></h3>
              <p class="text-muted text-center"><?= $job ?></p>
            </div>
            <div class="col-md-8">
              <form class="form-horizontal" action="/profile/editMain" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="text"  class="form-control" value="<?= $name ?>"  placeholder="Name" name="name">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="text"  class="form-control" value="<?= $email ?>" placeholder="Email" name="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="text"  class="form-control" value="<?= $job ?>" placeholder="Job" name="job">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="text"  class="form-control" value="<?= $phone ?>" placeholder="Phone" name="phone">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="text"  class="form-control"  placeholder="Password" name="password"></input>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="file"  style="padding: 4px 0;border:none" name="img" >
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-danger col-md-10 form-control">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
        <!-- /.col -->
    </div>
      <!-- row -->
  </div>
  <!-- /.container -->
</section>
    <!-- /.content -->
<?php include "inc/footer.php" ?>

