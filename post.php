<?php require_once ('./controller/Post.php');?>
<?php
    $Posts = new Posts();
    $Response = [];
    $active = $Posts->active;

    if(isset($_POST) && count($_POST) > 0) $Response = $Posts->posts($_POST);
?>
<?php require ('./nav.php'); ?>
<main role="main" class="container">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4 center-align center-block">
                <?php if (isset($Response['status']) && !$Response['status']) : ?>
                    <br>
                    <div class="alert alert-danger" role="alert">
                        <span><B>Oops!</B> Some errors occurred in your form.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" class="text-danger">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="card shadow-lg p-4 mb-5 bg-white rounded">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin">
                        <h4 class="h3 mb-3 font-weight-normal text-center">Post a News</h4>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                            <div class="form-group">
                                <label for="inputTitle" class="sr-only">Title</label>
                                <input type="text" name="title" id="inputTitle" class="form-control" placeholder="Enter A Title" required>
                                <?php if (isset($Response['title']) && !empty($Response['title'])): ?>
                                    <small class="text-danger"><?php echo $Response['title']; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
                            <div class="form-group">
                                <label for="inputContent" class="sr-only">Content</label>
                                <textarea rows="9" type="text" id="inputContent" class="form-control row-5" placeholder="Enter News Content" name="content" required autofocus
                                          value="<?php if (isset($_POST['content'])) echo $_POST['content']; ?>"></textarea>
                                <?php if (isset($Response['content']) && !empty($Response['content'])): ?>
                                    <small class="text-danger"><?php echo $Response['content']; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                            <button class="btn btn-md btn-primary btn-block" type="submit">Post</button>
                        </div>
                        <p class="mt-5 text-center mb-3 text-muted">&copy; Shaon <?php echo date('Y'); ?></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
