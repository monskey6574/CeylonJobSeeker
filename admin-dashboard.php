<?php 
include("./config/config.php");
session_start();

$toastMessage = isset($_SESSION['toastMessage']) ? $_SESSION['toastMessage'] : "";
$toastClass = isset($_SESSION['toastClass']) ? $_SESSION['toastClass'] : "";

// Clear the session variables for new messages
unset($_SESSION['toastMessage']);
unset($_SESSION['toastClass']);

// For debug purposes
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS - CDN -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <!-- Custom Styles -->
    <link rel="stylesheet" href="./styles/main.css" />
    <link rel="stylesheet" href="./styles/admin-dashboard.css" />
    <title>Dashboard</title>
  </head>
  <body>
    <div class="main-wrapper">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand-lg fixed-top w-full bg-body-tertiary">
        <div class="container-fluid px-lg-4">
          <a class="navbar-brand" href="index.html"
            ><img
              class="img-logo"
              src="./assets/images/logo.svg"
              alt="CJS Logo"
          /></a>
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
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  aria-current="page"
                  href="./index.html"
                  >Home</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="categories.html">Categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="faq.html">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">About Us</a>
              </li>
            </ul>
            <button class="btn btn-light" type="button">Logout</button>
          </div>
        </div>
      </nav>
      <!-- Navbar End -->
      <div class="container section-wrapper">
        <?php
              echo("<div id='submitStatusArea' class='$toastClass' role='alert'>
              $toastMessage
              </div>");
              ?>
        <div class="row create-section">
          <div class="col-12 col-lg-6">
            <!-- Add New Admin Start -->
            <h2 class="section-title">Add New <span>Admin</span></h2>
            <form
              class="form"
              id="addNewAdminForm"
              action="./php/add_new_admin.php"
              method="post"
            >
              <div class="mb-3">
                <label for="adminName" class="form-label">Full Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="adminName"
                  name="adminName"
                  placeholder="Enter Admin Name..."
                />
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  placeholder="Enter Username..."
                />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  name="password"
                  placeholder="Enter Password..."
                />
              </div>
              <button type="submit" class="btn-primary w-100 mt-3">
                Create Admin
              </button>
              <div
                id="addAdminAlertMessageArea"
                class="mt-4"
                role="alert"
              ></div>
            </form>
            <!-- Add New Admin End -->
            <h2 class="section-title">Current <span>Admins</span></h2>
            <div class="admins-list">
            <table class="table table-hover table-striped">
            <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Username</th>
              <th scope="col">Created At</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
          <?php
              $get_admin = "SELECT * FROM admins";
              $admins = mysqli_query($conn, $get_admin);
              if (mysqli_num_rows($admins) > 0) {
                while ($row = mysqli_fetch_assoc($admins)) {
                  echo "<tr>";
                  echo "<td>" . $row['id'] . "</td>";
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['username'] . "</td>";
                  echo "<td>" . date("d F, Y h:i A", strtotime($row['created_at'])) . "</td>";
                  echo "</tr>";
                }
              }
            ?>
          </tbody>
            </table>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <!-- Section: New Job Start -->
            <h2 class="section-title mb">Post A <span>New Job</span></h2>
            <form
              class="form"
              id="jobPostForm"
              method="post"
              enctype="multipart/form-data"
              action="./php/add_new_job_as_admin.php"
            >
              <div class="mb-3">
                <label for="jobTitle" class="form-label">Company Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="companyName"
                  name="companyName"
                  placeholder="Enter Company Name..."
                />
              </div>
              <div class="mb-3">
                <label for="jobTitle" class="form-label">Company Logo</label>
                <input 
                type="file" 
                class="form-control" 
                name="companyLogo" 
                id="companyLogo"
                accept="image/*"
                required
                />
              </div>
              <div class="mb-3">
                <label for="jobTitle" class="form-label">Job Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="jobTitle"
                  name="jobTitle"
                  placeholder="Enter Job Title"
                />
              </div>
              <div class="mb-3">
                <label for="jobDescription" class="form-label"
                  >Job Description</label
                >
                <textarea
                  class="form-control"
                  id="jobDescription"
                  name="jobDescription"
                  rows="3"
                  placeholder="Enter Job Description"
                ></textarea>
              </div>
              <div class="mb-3">
                <label for="jobCategory" class="form-label">Job Category</label>
                <select class="form-select" id="jobCategory" name="jobCategory">
                  <option selected>Select Job Category</option>
                  <option value="1">IT</option>
                  <option value="2">Accounting</option>
                  <option value="3">Marketing</option>
                  <option value="4">Engineering</option>
                  <option value="5">Teaching</option>
                  <option value="6">Medical</option>
                  <option value="7">Other</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="jobLocation" class="form-label">Job Location</label>
                <input
                  type="text"
                  class="form-control"
                  id="jobLocation"
                  name="jobLocation"
                  placeholder="Enter Job Location"
                />
              </div>
              <div class="mb-3">
                <label for="jobSalary" class="form-label">Job Salary</label>
                <input
                  type="number"
                  class="form-control"
                  id="jobSalary"
                  name="jobSalary"
                  placeholder="Enter Job Salary"
                />
              </div>
              <div class="mb-3">
                <label for="jobType" class="form-label">Job Type</label>
                <select class="form-select" id="jobType" name="jobType">
                  <option selected>Select Job Type</option>
                  <option value="Full Time">Full Time</option>
                  <option value="Part Time">Part Time</option>
                  <option value="Contract">Contract</option>
                  <option value="Internship">Internship</option>
                  <option value="Temporary">Temporary</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="jobDeadline" class="form-label">Job Deadline</label>
                <input
                  type="date"
                  class="form-control"
                  id="jobDeadline"
                  name="jobDeadline"
                  placeholder="Enter Job Deadline"
                />
              </div>
              <button type="submit" class="btn-primary w-100">Submit</button>
              <div id="jobPostAlertMessageArea" class="mt-4" role="alert"></div>
            </form>
            <!-- Section: New Job End -->
          </div>
        </div>
        <h2 class="section-title">Job <span>Dashboard</span></h2>
      <div class="col-12 job-listing-dashboard">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Company Name</th>
              <th scope="col">Job Title</th>
              <th scope="col">Description</th>
              <th scope="col">Job Location</th>
              <th scope="col">Salary</th>
              <th scope="col">Job Type</th>
              <th scope="col">Deadline</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody id="jobListTableBody">
            <?php
              $sql = "SELECT * FROM jobs";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row['id'] . "</td>";
                  echo "<td>" . $row['company'] . "</td>";
                  echo "<td>" . $row['title'] . "</td>";
                  echo "<td>" . $row['description'] . "</td>";
                  echo "<td>" . $row['location'] . "</td>";
                  echo "<td>" . $row['salary'] . "</td>";
                  echo "<td>" . $row['type'] . "</td>";
                  echo "<td>" . $row['deadline'] . "</td>";
                  echo "<td class='dashboard-action-btns'><a href='./php/delete_job.php?job_id=" . $row['id'] . "' class='btn btn-danger'><i class='fa-solid fa-trash'></i></a><a href='./php/update_job.php?job_id=" . $row['id'] . "' class='btn btn-secondary'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                  echo "</tr>";
                }
              }

              ?>
          </tbody>
        </table>
      </div>
      </div>
      <!-- Footer Start -->
      <footer class="w-100">
        <div class="footer">
          <div class="footer-section flex-grow-1 mb-3">
            <a class="brand-text" href="index.html"
            ><img
            class="img-logo"
            src="./assets/images/logo-light.svg"
            alt="CJS Logo"
            />CeylonJobSeeker</a
            >
            <div class="site-info">
              <span
              >Designed and developed by Software Engineering
                Undergraduates</span
              >
              <span
                ><a rel="noopener" href="https://nsbm.ac.lk" target="_blank"
                  >NSBM Green University</a
                ></span
              >
            </div>
          </div>

          <div class="footer-section flex-grow-1">
            <h6>Quick Links</h6>
            <ul>
              <li>
                <a href="#">Home</a>
              </li>
              <li>
                <a href="#">Categories</a>
              </li>
              <li>
                <a href="#">FAQ</a>
              </li>
              <li>
                <a href="#">Contact Us</a>
              </li>
              <li>
                <a href="#">About Us</a>
              </li>
            </ul>
          </div>
          <div class="footer-section flex-grow-1">
            <h6>Support</h6>
            <ul>
              <li>
                <a href="#">FAQ</a>
              </li>
              <li>
                <a href="#">Privacy Policy</a>
              </li>
              <li>
                <a href="#">Customer Support</a>
              </li>
              <li>
                <a href="#">Terms of Service</a>
              </li>
            </ul>
          </div>
          <div class="footer-section flex-grow-1">
            <h6>Social</h6>
            <div class="social-icon-links">
              <a href="#" title="LinkedIn">
                <i class="fa-brands fa-linkedin-in"></i>
              </a>
              <a href="#" title="Facebook">
                <i class="fa-brands fa-facebook-f"></i>
              </a>
              <a href="#" title="GitHub">
                <i class="fa-brands fa-github"></i>
              </a>
              <a href="#" title="Twitter">
                <i class="fa-brands fa-twitter"></i>
              </a>
            </div>
          </div>
        </div>
        <hr class="w-100 divider" height="2" />
        <div class="footer-end">
          <span>Copyright &copy; 2023 | All rights reserved.</span>

          <span>Cookies</span>
        </div>
      </footer>
      <!-- Footer End -->
    </div>
    <!-- Custom JS -->
    <script src="./js/admin-dashboard.js"></script>
    <!-- Popper - CDN -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!-- Fontawesome - CDN -->
    <script
      src="https://kit.fontawesome.com/0a73ff5289.js"
      crossorigin="anonymous"
    ></script>
    <!-- Bootstrap JS - CDN -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
      integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
