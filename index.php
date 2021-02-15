<?php  

include_once 'class/Task.php';
$task = new Task();
$task->setStatus(2);
$taskInfo = $task->getAllTask();
include 'templates/header.php';

?>

<section class="showcase">
  <div class="container">
    <div class="pb-2 mt-4 mb-2 border-bottom">
      <h2>Build a Simple To-Do List Application with PHP & Ajax</h2>
    </div>
    <div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card px-3">
                    <div class="card-body">
                        <h4 class="card-title">Todo list</h4>
                        <div class="add-items d-flex"> <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> <button class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button> </div>
                        <div class="list-wrapper">
                            <ul class="d-flex flex-column-reverse todo-list">
                               <?php foreach($taskInfo as $key=>$element) { 
                                  if(!empty($element['status']) && $element['status'] === 1){
                                    $class = 'class="completed"';
                                    $checked = 'checked="checked"';
                                  } else {
                                    $class = '';
                                    $checked = '';
                                  }
                                ?>
 
                                <li <?php print $class; ?>>
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox" <?php print $checked; ?> data-utaskid="<?php print $element['id']; ?>"> <?php print $element['task']?> <i class="input-helper"></i></label> </div> <i data-dtaskid="<?php print $element['id']; ?>" class="remove fa fa-times"></i>
                                </li>
                              <?php } ?>
 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>
<?php include('templates/footer.php');?>