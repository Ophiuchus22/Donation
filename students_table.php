<?php
include "db_conn.php";

// Retrieve departments from the database
$dept_sql = "SELECT dept_id, dept_name FROM departments";
$dept_result = $conn->query($dept_sql);

// Retrieve users with role "student" from the database
$sql = "SELECT user_id, ID, First_name, Lastname, CONCAT(First_name, ' ', Lastname) AS table_name, Email, Department, Status FROM user WHERE role = 'student'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">

  <style>
    .nav-item form {
        margin-top: 50px; 
    }
  </style>

</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light"></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <p><br></p>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="students_table.php" class="nav-link">
                    <i class="fas fa-user-graduate nav-icon"></i>
                    <p>Students</p>
                  </a>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="teachers_table.php" class="nav-link">
                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Teachers</p>
                  </a>
              </ul>
              <br>
              <hr>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add_departments.php" class="nav-link">
                    <i class="fas fa-building nav-icon"></i>
                    <p>Departments</p>
                  </a>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add_subjects.php" class="nav-link">
                    <i class="fas fa-book nav-icon"></i>
                    <p>Subjects</p>
                  </a>
              </ul>
              <br>
              <hr>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="admin_dash.php" class="nav-link">
                    <i class="fas fa-user-alt nav-icon"></i>
                    <p>User profile</p>
                  </a>
              </ul>
            </li>
            <li class="nav-item">
              <form action="logout.php" method="post">
                <button type="submit" id="signOutBtn" class="nav-link btn btn-primary btn-lg" style="padding: 5px 10px; height: auto; background-color: transparent; border: 1px solid #ccc;">
                  <i class="nav-icon fas fa-sign-out-alt"></i> 
                  <span style="color: white; font-weight: bold;">Sign out</span>
                  <span class="right badge badge-danger"></span>
                </button>
              </form>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Students</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?php
          // Check if message or error parameter is set in the URL
          if (isset($_GET['message'])) {
            echo '<div class="alert alert-success">' . $_GET['message'] . '</div>';
          } elseif (isset($_GET['error'])) {
            echo '<div class="alert alert-danger">' . $_GET['error'] . '</div>';
          }
          ?>
          <!-- start -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">List of students</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="tableBody">
                      <?php
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo "<tr id='row_" . $row["user_id"] . "'>";
                          echo "<td>" . $row["ID"] . "</td>"; // Displaying ID
                          echo "<td>" . $row["table_name"] . "</td>"; // Displaying Name
                          echo "<td>" . $row["Email"] . "</td>"; // Displaying Email
                          echo "<td>" . $row["Department"] . "</td>"; // Displaying Department
                          echo "<td>" . $row["Status"] . "</td>"; // Displaying Status
                          echo "<td>";
                          echo "<a href='index_students.php?action=approve&user_id=" . $row["user_id"] . "' class='btn btn-success btn-sm mr-1'>Enroll</a>";
                          echo "<a href='index_students.php?action=decline&user_id=" . $row["user_id"] . "' class='btn btn-danger btn-sm mr-1'>Decline</a><br>";
                          echo "<button class='btn btn-primary btn-sm editBtn' data-id='" . $row["user_id"] . "' data-firstname='" . $row["First_name"] . "' data-lastname='" . $row["Lastname"] . "' data-email='" . $row["Email"] . "' data-department='" . $row["Department"] . "' data-status='" . $row["Status"] . "'>Edit</button> ";
                          echo "<a href='index_students.php?action=delete&user_id=" . $row["user_id"] . "' class='btn btn-warning btn-sm mr-1' style='margin-top: 5px;'>Delete</a>";
                          echo "</td>";
                          echo "</tr>";

                          // Add hidden edit form for each row
                          echo "<tr id='editForm_" . $row["user_id"] . "' style='display:none;'>
                            <td colspan='6'>
                              <form action='index_students.php' method='post'>
                                <div class='form-group'>
                                    <label>Firstname</label>
                                    <input type='hidden' name='user_id' value='" . $row["user_id"] . "'>
                                    <input type='text' class='form-control' name='firstname' value='" . $row["First_name"] . "'>
                                </div>
                                <div class='form-group'>
                                    <label>Lastname</label>
                                    <input type='text' class='form-control' name='lastname' value='" . $row["Lastname"] . "'>
                                </div>
                                <div class='form-group'>
                                  <label>Department</label>
                                  <select class='form-control' name='department'>";
                                  // Populate department options
                                  $dept_result->data_seek(0);
                                  if ($dept_result->num_rows > 0) {
                                    while ($dept_row = $dept_result->fetch_assoc()) {
                                      $selected = $dept_row["dept_name"] == $row["Department"] ? "selected" : "";
                                      echo "<option value='" . $dept_row["dept_name"] . "' $selected>" . $dept_row["dept_name"] . "</option>";
                                    }
                                  }
                          echo "</select>
                                </div> 
                                <button type='submit' class='btn btn-primary btn-sm'>Save</button>
                              </form>
                            </td>
                          </tr>";
                        }
                      } else {
                        echo "<tr><td colspan='6'>No students found</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- End -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->
                            
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // URL Parameter Cleanup
    if (window.history.replaceState) {
      const url = new URL(window.location.href);
      url.searchParams.delete('message');
      url.searchParams.delete('error');
      window.history.replaceState({ path: url.href }, '', url.href);
    }

    // Automatic Message Hiding
    const alertMessages = document.querySelectorAll('.alert-danger, .alert-success');
    if (alertMessages) {
      alertMessages.forEach(function(message) {
        setTimeout(() => message.style.display = 'none', 4000);
      });
    }

    // Show hidden edit form
    const tableBody = document.getElementById('tableBody');
    tableBody.addEventListener('click', (event) => {
      if (event.target.classList.contains('editBtn')) {
        const editFormId = `editForm_${event.target.dataset.id}`;
        const editForm = document.getElementById(editFormId);
        if (editForm.style.display === 'none' || editForm.style.display === '') {
          editForm.style.display = 'table-row';
        } else {
          editForm.style.display = 'none';
        }
      }
    });

  });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery -->
<script src="jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>

</body>
</html>
