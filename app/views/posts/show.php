<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT?>/posts" class="btn btn-dark mt-4"><i class="fa fa-backward"> Go back</i></a>
<br><br>
<h1><?php echo $data["post"]->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
<p>Written by <?php echo $data["user"]->name; ?> on <?php echo $data["post"]->created_at ?></p>
</div>
<p><?php echo $data["post"]->body;?></p>
<?php if($data["post"]->user_id == $_SESSION["user_id"]) : ?>
    <hr>
    <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data["post"]->id ?>" class="btn btn-warning">Edit post</a>
<form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data["post"]->id ?>" method="post" class="pull-right">
<input type="submit" value="Delete" class="btn btn-danger">

</form>
<?php endif ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>