<?php
require_once("db.php");

session_start();

if(empty($_SESSION['email']))
{
  header('Location: signInForm.php');
  exit;
}

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
$tasks = array();
while($row = $result->fetch_assoc()){
$tasks[]=$row;
}
$conn->close();


function isDoneText($val){
  $text = "Done";
  return $text;
}

if(isset($_POST['newTaskBtn'])){
  session_start();
  $_SESSION['titleInput'] = $_POST['titleInput'];

  $_SESSION['writerInput'] = $_POST['writerInput'];

  $_SESSION['dateInput'] = $_POST['dateInput'];
}

if(isset($_POST['saveEditBtn'])){

}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/style.css" />

     <!-- jQuery -->
     <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <!-- Bootstrap Bundle with Popper -->
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
    crossorigin="anonymous"
    ></script>

    <script src="js/myScript.js" type="text/javascript"></script>

    <!--Vue -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <title>TasksList</title>
  </head>
  <body class="p-3 mb-2 bg-dark text-white" style="overflow:auto;">
    <nav id="homepageNav" class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" id="homepageLogo">EZM</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a
                class="nav-link active"
                aria-current="page"
                href="taskList.php"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a
                class="nav-link disabled"
                href="#"
                tabindex="-1"
                aria-disabled="true"
                >Disabled</a
              >
            </li>
          </ul>
          <form class="d-flex" action="logout.php">
            <button class="btn btn-dark" type="submit" id="logOutBtn">Logout</button>
          </form>
        </div>
      </div>
    </nav>
    <br />
    <br />
    <header id="tasks">Tasks</header>
    <br />

    <div class="container" id="taskContainer">
      <div class="row">
        <div class="col-12">
          <table class="table table-dark table-striped" id="tasksTable">
            <thead>
              <tr>
                <th>Title</th>
                <th>Writer</th>
                <th>Due Date</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody id="tasksTableBody">
            <?php foreach ($tasks as  $task): ?>

            <tr data-id='<?=$task['taskID'];?>'>
                
                <td class="taskName"><?=$task["taskName"];?></td>
                <td class="writer"><?=$task["taskWriter"];?></td>
                <td class="date"><?=$task["deadline"];?></td>

                <?php if($task["finished"] != 0): ?>                                                                                          
                <td class="isDone"><?=isDoneText($task["finished"])?><input
                class="form-check-input mt-0"
                type="checkbox"
                value=""
                aria-label="Checkbox for following text input"  
                checked
                ;?></td>
                <?php endif; ?>

                <?php if($task["finished"] == 0): ?>                                                                                          
                <td class="isDone"><?=isDoneText($task["finished"])?><input
                class="form-check-input mt-0"
                type="checkbox"
                value=""
                aria-label="Checkbox for following text input"  
                ;?></td>
                <?php endif; ?>

                <td>  <!-- Button trigger for editing tasks modal -->
                <button type="button" class="editBtn btn btn-link" data-bs-toggle="modal"
                data-bs-target="#editModal">Edit</button> </td>
                <td>  <!-- Button trigger for deleting tasks modal -->
                      <button
                      type="button"
                      class="btn delTaskBtn btn-danger"
                      data-bs-toggle="modal"
                      data-bs-target="#deleteConf"
                      id="'.$task->taskID.'"
                      >
                      Delete
                      </button> 
                </td>

            </tr>
        <?php endforeach;?>
            </tbody>
          </table>

          <!-- Modal for deleting tasks confirmation-->
          <div
            class="modal fade"
            id="deleteConf"
            tabindex="-1"
            aria-labelledby="deleteConfLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteConfLabel">Modal title</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body" style="color: black"></div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Cancel
                  </button>
                  <button
                    type="button"
                    class="btn btn-primary"
                    id="delTaskConfBtn"
                  >
                    Save changes
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Button trigger for adding tasks modal -->
          <button
            type="button"
            class="btn btn-outline-success"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            id="newTaskTrigger"
          >
            New Task +
          </button>

          <!-- <button type="submit" id="logOutBtn" class="btn btn-danger" style="height:40px; width:80px; float:right;">Logout</button> -->
        </div>
      </div>
    </div>

    <!-- Modal for adding new tasks-->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
    <form id="taskAdditionForm">
      <div class="modal-dialog" id="deleteDialog" >
        <div class="modal-content bg-dark">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="modal-body mx-3">
              <div class="md-form mb-5">
                <i class="fas fa-envelope prefix grey-text"></i>
                <label data-error="wrong" data-success="right" for="titleInput"
                  >Title</label
                >
                <input
                  type="text"
                  class="form-control validate"
                  id="titleInput"
                  name="titleInput"
                  list="datalistOptions"
                />
              
                <datalist id="datalistOptions">
                  <option value="Intro to computer Science"></option>
                  <option value="Calculus 1"></option>
                  <option value="Algebra 1"></option>
                  <option value="Discrete math"></option>
                  <option value="OOP"></option>
                  <option value="Calculus 2"></option>
                </datalist>

                <i class="fas fa-envelope prefix grey-text"></i>
                <label data-error="wrong" data-success="right" for="writerInput"
                  >Writer</label
                >
                <input
                  type="text"
                  class="form-control validate"
                  id="writerInput"
                  name="writerInput"
                />

                <i class="fas fa-lock prefix grey-text"></i>
                <label data-error="wrong" data-success="right" for="dateInput"
                  >Due Date</label
                >
                <input
                  type="date"
                  id="dateInput"
                  name="dateInput"
                  class="form-control validate"
                />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-danger"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="submit" class="btn btn-success" id="newTaskBtn" name="newTaskBtn">
              Save changes
            </button>
          </div>
        </div>
      </div>
                </form>
    </div>
                </div> 

    <!-- Modal for editing tasks-->
    <div
      class="modal fade"
      id="editModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
    <form id="taskEditForm">
      <div class="modal-dialog">
        <div class="modal-content bg-dark">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="modal-body mx-3">
              <div class="md-form mb-5">
                <i class="fas fa-envelope prefix grey-text"></i>
                <label
                  data-error="wrong"
                  data-success="right"
                  for="titleInputEdit"
                  >Title</label
                >
                <input
                  type="text"
                  class="form-control validate"
                  id="titleInputEdit"
                  name="titleInputEdit"
                />
                <i class="fas fa-envelope prefix grey-text"></i>
                <label
                  data-error="wrong"
                  data-success="right"
                  for="writerInputEdit"
                  >Writer</label
                >
                <input
                  type="text"
                  class="form-control validate"
                  id="writerInputEdit"
                  name="writerInputEdit"
                />

                <i class="fas fa-lock prefix grey-text"></i>
                <label
                  data-error="wrong"
                  data-success="right"
                  for="dateInputEdit"
                  >Due Date</label
                >
                <input
                  type="date"
                  id="dateInputEdit"
                  name="dateInputEdit"
                  class="form-control validate"
                />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-danger"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="submit" class="btn btn-success" id="saveEditBtn" name="saveEditBtn">
              Save changes
            </button>
          </div>
        </div>
      </div>
                </form>

    <!-- <footer>&copy; Copyright 2021 EZM Inc. All Rights Reserved.</footer> -->
  </body>
</html>


<?php require_once("footer.php");?>