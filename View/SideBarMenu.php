 <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'Dashbord') !== false) ? 'active' : ''; ?>" href="Dashbord">
            <?php if (strpos($_SERVER['REQUEST_URI'], 'Dashbord') !== false) echo '<i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;'; ?>

              <i class="fa-solid fa-chart-line"></i> &nbsp;&nbsp; Dashboard 
            </a>
          </li><br><br>
          <li class="nav-item">
            <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'Clients') !== false) ? 'active' : ''; ?>" href="Clients">
            <?php if (strpos($_SERVER['REQUEST_URI'], 'Clients') !== false) echo '<i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;'; ?>
              <i class="fa-solid fa-users"></i> &nbsp;&nbsp; Clients 
              </a>
          </li><br><br>
          <li class="nav-item">
            <a class="nav-link" href="Cars">
              <i class="fa-solid fa-car"></i> &nbsp;&nbsp; Voitures
            </a>
          </li><br><br>
          <li class="nav-item">
            <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'Reservations') !== false) ? 'active' : ''; ?>" href="Reservations">
            <?php if (strpos($_SERVER['REQUEST_URI'], 'Reservations') !== false) echo '<i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;'; ?>
           <i class="fa-solid fa-file-contract"></i> &nbsp;&nbsp; Réservations 
            </a>
          </li>
        </ul>

      </div>
    </nav>
  </div>
</div>
<style>
  .nav-link.active {
    color: #3384ff;
  }
</style>
