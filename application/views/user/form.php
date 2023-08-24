<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengguna Form
        <small>List Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Pengguna Form</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('user/create');?>">Input Sales</a></li>
            <li role="presentation"><a href="<?php echo site_url('user');?>">List Sales</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Sales</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($user)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('user/save').'/'.$user['id'];?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('user/save');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="username">Username</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($user) ? $user['username'] : '';?>" name="username" placeholder="Nama Username" id="username" class="form-control"/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="password">Password</label>
                    <div class="col-sm-8">
                      <input type="password" value="" name="password" placeholder="Password" id="password" class="form-control"/>
                      <?php echo !empty($user)? '<span>Isi jika ingin diubah</span>' : '';?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Nama</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($user) ? $user['name'] : '';?>" name="name" placeholder="Nama Pengguna" id="user" class="form-control"/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="phone">Email</label>
                    <div class="col-sm-8">
                      <input type="email" value="<?php echo !empty($user) ? $user['email'] : '';?>" name="email" placeholder="Email" id="email" class="form-control"/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="jabatan">Jabatan</label>
                    <div class="col-sm-8">
                      <?php
                        $jabatan = !empty($user) ? $user['jabatan'] : '';
                      ?>
                      <select name="jabatan" class="form-control">
                        <option value="1" <?php echo $jabatan == 1? 'selected' : '';?>>Admin</option>
                        <option value="2" <?php echo $jabatan == 2? 'selected' : '';?>>Pegawai</option>
                        <option value="3" <?php echo $jabatan == 3? 'selected' : '';?>>HRD/Manager Sales/Accounting</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('supplier');?>">Cancel</a>
                  <button class="btn btn-info pull-right" type="submit">Save</button>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		</div>
        <!-- /.col -->
      </div>
	  <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>