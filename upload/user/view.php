<?php
if(empty($_GET['id'])){
    header("Location: manage.php");
}

// Include and initialize DB class
require_once 'DB.class.php';
$db = new DB();

$conditions['where'] = array(
    'id' => $_GET['id'],
);
$conditions['return_type'] = 'single';
$galData = $db->getRows($conditions);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bedspace View</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
function deleteImage(id){
    var result = confirm("Are you sure to delete?");
    if(result){
        $.post( "postAction.php", {action_type:"img_delete",id:id}, function(resp) {
            if(resp == 'ok'){
                $('#imgb_'+id).remove();
                alert('The image has been removed from the gallery');
            }else{
                alert('Some problem occurred, please try again.');
            }
        });
    }
}
</script>
  </head>
  <body>
    <header id="mu-hero">
  		<div class="container">
  			<nav class="navbar navbar-expand-lg navbar-light mu-navbar">
  				<!-- Text based logo -->
  				<a class="navbar-brand mu-logo" href="index.html">title<span class="spancurves"> /title.</span></a>
        </nav>
      </div>
    </header>
    <main>
      <section id="mu-service">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5><?php echo !empty($galData['title'])?$galData['title']:''; ?></h5>

                <?php if(!empty($galData['images'])){ ?>
                    <div class="gallery-img">
                    <?php foreach($galData['images'] as $imgRow){ ?>
                        <div class="img-box" id="imgb_<?php echo $imgRow['id']; ?>">
                            <img src="uploads/images/<?php echo $imgRow['file_name']; ?>">

                        </div>
                    <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <a href="index.php" class="btn btn-primary">Back to List</a>
        </div>
      </div>
    </section>
  </main>
  </body>
</html>
