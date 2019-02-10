<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
<?php flash("post_message");?>
  <div class="row m-3">
    <div class="col-md-6 mb-1">
      <h1>Posts</h1>
    </div>
    <div class="col-md-6 mb-1">
      <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Post
      </a>
    </div>
  </div>
  </div>
<?php foreach ($data["posts"] as $post) :?> 
  <div class="card card-body mb-3">
    <h4 class="card-title"><?php echo $post->title; ?></h4>
    <div class="bg-light mb-3 p-2">
      <p>Written by: <?php echo $post->name; ?> on <?php echo $post->created_at ?> </p>
    </div>
    <p class="card-text"><?php echo $post->body; ?> </p>
    <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId ?>" class="btn btn-dark">More</a>
  </div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>