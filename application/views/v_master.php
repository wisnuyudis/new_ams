<div class="col-md-10">
<?php echo $this->session->flashdata('msg');?>
		  	<div class="row">
              <div class="col-md-6">
  					<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title">Jenis Surat</div>
							
							<div class="panel-options">
              <button type="button" id="btn-add" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modaladdjs">
             <i class="fa fa-plus"></i>&nbsp;Add</button>
							</div>
						</div>
		  				<div class="panel-body">
		  					<table class="table table-hover">
				              <thead>
				                <tr>
				                  <th>ID</th>
				                  <th>Jenis Surat</th>
                                  <th>Action</th>
				                </tr>
				              </thead>
				              <tbody>
                                <?php
                                    if( ! empty($js)){
                                    foreach($js->result_array() as $jenis_surat) {
                                    $id = $jenis_surat['id'];
                                    $fjenis_surat = $jenis_surat['jenis_surat'];
                                ?>
                                <tr>
                                    <th><?php echo $id;?></th>
                                    <th><?php echo $fjenis_surat;?></th>
                                    <th style="text-align:center;">
                                    <a id="data_detail" class="btn btn-danger detail" href="<?php echo base_url()?>data_master/hapus_js/<?=$id ?>" onclick="return confirm('You sure to delete?')">
                                        <i class="fas fa-trash-alt"></i>
                                </tr>
                                <?php }
                                }else{ // Jika data tidak ada
                                echo "<tr><td colspan='4'>Data tidak ada</td></tr>";} ?>
				              </tbody>
				            </table>
		  				</div>
		  			</div>
  				</div>
  				<div class="col-md-6">
  					<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title">Bidang</div>
							
							<div class="panel-options">
              <button type="button" id="btn-add" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modaladdsas">
             <i class="fa fa-plus"></i>&nbsp;Add</button>
							</div>
						</div>
		  				<div class="panel-body">
		  					<table class="table table-hover">
				              <thead>
				                <tr>
				                  <th>ID</th>
				                  <th>Sasaran</th>
				                  <th>Action</th>
				                </tr>
				              </thead>
				              <tbody>
                              <?php
                                    if( ! empty($sas)){
                                    foreach($sas->result_array() as $bidang) {
                                    $id = $bidang['id'];
                                    $fbidang = $bidang['bidang'];
                                ?>
                                <tr>
                                    <th><?php echo $id;?></th>
                                    <th><?php echo $fbidang;?></th>
                                    <th style="text-align:center;">
                                    <a id="data_detail" class="btn btn-danger detail" href="<?php echo base_url()?>data_master/hapus_sasaran/<?=$id ?>" onclick="return confirm('You sure to delete?')">
                                        <i class="fas fa-trash-alt"></i>
                                </tr>
                                <?php }
                                }else{ // Jika data tidak ada
                                echo "<tr><td colspan='4'>Data tidak ada</td></tr>";} ?>
				              </tbody>
				            </table>
		  				</div>
		  			</div>
  				</div>
  			</div>

  			
              <div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">Data User</div>
            <div class="panel-options">
              <button type="button" id="btn-add" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modaladduser">
              <i class="fa fa-plus"></i>&nbsp;Add</button>
					  </div>
				</div>
  				<div class="panel-body">
  					<div class="table-responsive">
  						<table class="table">
			              <thead>
			                <tr>
			                  <th>ID</th>
			                  <th>Nama</th>
			                  <th>Unit</th>
			                  <th>Username</th>
                              <th>Password</th>
			                  <th>Level</th>
                              <th>Action</th>
			                </tr>
			              </thead>
			              <tbody>
                          <?php
                                    if( ! empty($u)){
                                    foreach($u->result_array() as $user) {
                                    $id = $user['id'];
                                    $nama = $user['nama'];
                                    $unit = $user['unit'];
                                    $username = $user['username'];
                                    $password = $user['password'];
                                    $level = $user['level'];
                                ?>
                                <tr>
                                    <th><?php echo $id;?></th>
                                    <th><?php echo $nama;?></th>
                                    <th><?php echo $unit;?></th>
                                    <th><?php echo $username;?></th>
                                    <th><?php echo $password;?></th>
                                    <th><?php echo $level;?></th>
                                    <th style="text-align:center;">
                                        <a id="data_detail" class="btn btn-danger detail" href="<?php echo base_url()?>data_master/hapus_user/<?=$id ?>" onclick="return confirm('You sure to delete?')">
                                        <i class="fas fa-trash-alt"></i>
                                </tr>
                                <?php }
                                }else{ // Jika data tidak ada
                                echo "<tr><td colspan='4'>Data tidak ada</td></tr>";} ?>
			              </tbody>
			            </table>
  					</div>
  				</div>
  			</div>              
  			</div>
<!-- ---------------------------MODAL ADD JENIS SURAT------------------------- -->
<div class="modal fade" id="modaladdjs" tabindex="-1" role="dialog" aria-labelledby="modaladdjs" aria-hidden="true">
<div class="modal-dialog modal-xs">
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
        <h5 class="modal-title" id="modaladdLabel">Tambah Jenis Surat</h5>
  </div>
      <div class="modal-body">
        <div class="panel-body">
			<form action="<?=base_url('data_master/tambah_js')?>" method="post" enctype="multipart/form-data">
				<fieldset>
					<div class="form-group">
						<label>Jenis Surat</label>
						<input class="form-control" id="jenis_surat" name="jenis_surat" placeholder="Masukan jenis surat..." type="text" required>
					</div>
				</fieldset>
                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Submit</button>
			</form>
		</div>
      </div>
      </div>
  </div>
</div>
</div>
<!-- ---------------------------MODAL ADD BIDANG------------------------- -->
<div class="modal fade" id="modaladdsas" tabindex="-1" role="dialog" aria-labelledby="modaladdsas" aria-hidden="true">
<div class="modal-dialog modal-xs">
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
        <h5 class="modal-title" id="modaladdLabel">Tambah Bidang</h5>
  </div>
      <div class="modal-body">
        <div class="panel-body">
			<form action="<?=base_url('data_master/tambah_sasaran')?>" method="post" enctype="multipart/form-data">
				<fieldset>
					<div class="form-group">
						<label>Bidang</label>
						<input class="form-control" id="bidang" name="bidang" placeholder="Masukan bidang..." type="text" required>
					</div>
				</fieldset>
                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Submit</button>
			</form>
		</div>
      </div>
      </div>
  </div>
</div>
</div>
<!-- ---------------------------MODAL ADD USER------------------------- -->
<div class="modal fade" id="modaladduser" tabindex="-1" role="dialog" aria-labelledby="modaladduser" aria-hidden="true">
<div class="modal-dialog modal-xs">
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
        <h5 class="modal-title" id="modaladdLabel">Tambah User</h5>
  </div>
      <div class="modal-body">
        <div class="panel-body">
			<form action="<?=base_url('data_master/tambah_user')?>" method="post" enctype="multipart/form-data">
				<fieldset>
					<div class="form-group">
						<label>Nama</label>
						<input class="form-control" id="nama" name="nama" placeholder="Masukan nama..." type="text" required>
					</div>
          <div class="form-group">
						<label>Unit</label>
						<input class="form-control" id="unit" name="unit" placeholder="Masukan unit..." type="text" required>
					</div>
          <div class="form-group">
						<label>Username</label>
						<input class="form-control" id="username" name="username" placeholder="Masukan username..." type="text" required>
					</div>
          <div class="form-group">
						<label>Password</label>
						<input class="form-control" id="password" name="password" placeholder="Masukan password..." type="text" required>
					</div>
          <div class="form-group">
											<label>Level</label>
												<select class="form-control" id="level" name="level">
													<option>Super Admin</option>
													<option>Admin</option>
													<option>User</option>
												</select>
										</div>
                    <br/>
				</fieldset>
                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Submit</button>
			</form>
		</div>
      </div>
      </div>
  </div>
</div>
</div>