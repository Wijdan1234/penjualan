<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengguna Index
        <small>List Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Pengguna Index</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="<?php echo site_url('user/create');?>">Input Pengguna</a></li>
                <li role="presentation" class="active"><a href="<?php echo site_url('user');?>">List Pengguna</a></li>
            </ul>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table Pengguna</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo site_url('user?search=true');?>" method="GET">
                <input type="hidden" class="form-control" name="search" value="true"/>
                <div class="box-body pad">
                  <?php echo search_form('user');?>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <input type="submit" value="Cari" class="form-control btn btn-primary">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <a href="<?php echo site_url('user/export_csv').get_uri();?>" class="form-control btn btn-default"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    </div>
                  </div>
                </div>
              </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Code ID</th>
                  <th>Nama Pengguna</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Jabatan</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php if(isset($users) && is_array($users)){ ?>
                    <?php foreach($users as $user){?>
                    <tr>
                      <td><?php echo $user->id;?></td>
                      <td><?php echo $user->name;?></td>
                      <td><?php echo $user->username;?></td>
                      <td><?php echo $user->email;?></td>
                      <td><?php echo $user->jabatan;?></td>
                      <td>
                      <a href="<?php echo site_url('user/edit').'/'.$user->id;?>" class="btn btn-xs btn-primary">Edit</a>
                      <a onclick="return confirm('Are you sure you want to delete this user?');" href="<?php echo site_url('user/delete').'/'.$user->id;?>" class="btn btn-xs btn-danger">Delete</a>
                      </td>
                    </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Code ID</th>
                  <th>Nama Pengguna</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Jabatan</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="text-center">
              <?php echo $paggination;?>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
	  <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>