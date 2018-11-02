<!-- Header -->
<?php $this->load->view('core/header'); ?>
  
  <!-- Body - Sensor Index -->
  <body>

    <!-- Page Sidebar Nav -->
    <?php $this->load->view('core/nav'); ?>

    <!-- Page Content -->
    <div id="main">
        <!-- Page Header -->
        <?php $this->load->view('core/page_header'); ?>

        <!-- Page Sections -->
        <section class="climate pt-5">
            <h1>Technical</h1>
            <h4><a href="<?php echo base_url("technical/climate")?>">Climate Sensor</a></h4>
        </section>
        
    </div>

    <!-- Site Footer -->
    <?php $this->load->view('core/footer'); ?>

  </body>
  <!-- /Body -->

</html>