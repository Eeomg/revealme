<?php include "inc/header.php" ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Main content -->
    <section class="content mt-5">
      <div class="error-page">
        <h2 class="headline text-danger mr-3">Error</h2>
        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Sorry</h3>

        <p>
            <?= $error ?>
        </p>
        <a href="/">return to home page</a>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include "inc/footer.php" ?>
