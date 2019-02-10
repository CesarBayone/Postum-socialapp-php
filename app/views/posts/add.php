<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT?>/posts" class="btn btn-danger mt-4"><i class="fa fa-backward"> Go back</i></a>
      <div class="card card-body bg-light mt-5">
        <h2>Add Post</h2>
        <p>Please fill out this form to add a new Post to Postum.</p>
        <form action="<?php echo URLROOT; ?>/posts/add" method="post">
          <div class="form-group">
            <label for="title">Title: </label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
          </div>
          <div class="form-group">
            <label for="body">Your post: </label>
            <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_error'])) ? 'is-invalid' : ''; ?>"><?php echo $data["body"];?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_error']; ?></span>
          </div>
          <input type="submit" value="Add Post" class="btn btn-success">

        </form>
      </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>