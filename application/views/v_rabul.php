<div class="col-md-10">
  <?php echo $this->session->flashdata('msg');?>
    <div class="row">
    <div class="col-md-12">
      <div class="content-box-header panel-heading">
        <div class="panel-title ">View Rabul</div>

      <!-- <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
      </div> -->
      </div>
      <div class="content-box-large box-with-header">
        Ini view untuk rabul
        <div class="float-right">
            <button type="button" id="btn-add" class="btn btn-success" data-toggle="modal" data-target="#modaladd">
             <i class="fa fa-plus"></i>&nbsp;Add</button>
             <br/>
             <br/>

        <div class="table-responsive">
                <table class="table" id="tabel-data">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Nama Unit</th>
                            <th class="border-top-0">Bidang</th>
                            <th class="border-top-0">Bulan</th>
                            <th class="border-top-0">Publish</th>
                            <th class="border-top-0">Tanggal Publish</th>
                            <!-- <th class="border-top-0">File</th> -->
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        if( ! empty($me)){
                        foreach($me->result_array() as $memo) {
                          $id = $memo['id'];
                          $nama_unit = $memo['nama_unit'];
                          $bidang = $memo['bidang'];
                          $bulan = $memo['bulan'];
                          $publish = $memo['publish'];
                          $tgl_publish = $memo['tgl_publish'];
                          $file_rabul = $memo['file_rabul'];
                     ?>
                      <tr>
                          <th><?=$no++?></th>
                          <th><?php echo $nama_unit;?></th>
                          <th><?php echo $bidang;?></th>
                          <th><?php echo $bulan;?></th>
                          <th><?php echo $publish;?></th>
                          <th><?php echo $tgl_publish;?></th>
                          <th style="text-align:center;">
                              <a id="data_detail" class="btn btn-primary detail" target="_blank" href="<?php echo base_url()?>upload/file_rabul/<?=$file_rabul ?>">
                              <i class="fas fa-address-card"></i></a>
                              <button type="button" id="btn-edit" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $id?>">
                              <i class=" fas fa-pencil-alt"></i></button>
                          </th>
                      </tr>
                      <script type="text/javascript">
                        <?php if($this->session->userdata("level") == "User"){ ?>

                             $(document).ready(function(){
                               $("#btn-edit").remove();
                            });
                        <?php } ?>
                      </script>
                    <?php }
                    }else{ // Jika data tidak ada
                    echo "<tr><td colspan='4'>Data tidak ada</td></tr>";} ?>
                    </tbody>
                  </table>
      <br />
      <br />

    </div>
    </div>
  </div>
</div>
<!-- ---------------------------MODAL ADD------------------------- -->
<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modaladd" aria-hidden="true">
<div class="modal-dialog modal-xs">
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
        <h5 class="modal-title" id="modaladdLabel">Tambah Rabul</h5>
  </div>

      <div class="modal-body">
        <div class="panel-body">
			  					<form action="<?=base_url('rabul/tambah_aksi')?>" method="post" enctype="multipart/form-data">
									<fieldset>
                    <div class="form-group">
											<label>Nama Unit</label>
												<select class="form-control" id="nama_unit" name="nama_unit">
                          <option></option>
                        <?php foreach($unit->result_array() as $roww):?>
                          <option value="<?php echo $roww['unit'];?>"><?php echo $roww['unit'];?></option>
                        <?php endforeach;?>
												</select>
										</div>
                    <div class="form-group">
											<label>Bidang</label>
												<select class="form-control" id="bidang" name="bidang">
                          <option></option>
                          <?php foreach($bid->result_array() as $rowww):?>
                          <option value="<?php echo $rowww['bidang'];?>"><?php echo $rowww['bidang'];?></option>
                          <?php endforeach;?>
												</select>
										</div>
                    <div class="form-group">
											<label>Bulan</label>
												<select class="form-control" id="bulan" name="bulan" required>
                          <option></option>
                          <option value="Januari">Januari</option>
                          <option value="Februari">Februari</option>
                          <option value="Maret">Maret</option>
                          <option value="April">April</option>
                          <option value="Mei">Mei</option>
                          <option value="Juni">Juni</option>
                          <option value="Juli">Juli</option>
                          <option value="Agustus">Agustus</option>
                          <option value="September">September</option>
                          <option value="Oktober">Oktober</option>
                          <option value="November">November</option>
                          <option value="Desember">Desember</option>
												</select>
										</div>
                    <div class="form-group">
  											<label>File input</label>
  												<input type="file" class="btn btn-default" id="file_rabul" name="file_rabul">
  												<p class="help-block">
  													Masukan file pdf hasil scan.
  												</p>
  										</div>
									</fieldset>
                  <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Submit</button>
								</form>
			  				</div>
      <!-- <div class="modal-footer">
        <input type="submit" class="btn btn-warning" name="action" value="Print" />
        <input type="submit" class="btn btn-info" name="action" value="Export" />
      </div> -->
      </div>
         </form>
      </div>
  </div>
</div>
</div>
<!-- ---------------------------MODAL EDIT------------------------- -->
<?php
    foreach($me->result_array() as $memo) {
    $id = $memo['id'];
    $nama_unit = $memo['nama_unit'];
    $bidang = $memo['bidang'];
    $publish = $memo['publish'];
    $tgl_publish = $memo['tgl_publish'];
    $file_rabul = $memo['file_rabul'];
?>
<div class="modal fade" id="modalEdit<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="modalEdit<?php echo $id?>" aria-hidden="true">
<div class="modal-dialog modal-xs">
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
        <h5 class="modal-title" id="modalEditLabel">Edit Rabul</h5>
  </div>

      <div class="modal-body">
        <div class="panel-body">
			  					<form action="<?=base_url('rabul/update_aksi')?>" method="post" enctype="multipart/form-data">
									<fieldset>
                  <input type="hidden" id="id" name="id" value="<?php echo $id?>">
                  <input type="hidden" id="file_edit_rabul" name="file_edit_rabul" value="<?php echo $file_rabul?>">
                  <div class="form-group">
                    <label>Nama Unit</label>
                      <select class="form-control" id="nama_unit" name="nama_unit">
                      <?php foreach($unit->result_array() as $roww):?>
                        <option value="<?php echo $roww['unit'];?>" <?php if ($roww['unit']==$nama_unit){echo "selected";}?> ><?php echo $roww['unit'];?></option>
                      <?php endforeach;?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Bidang</label>
                      <select class="form-control" id="bidang" name="bidang">
                        <?php foreach($bid->result_array() as $rowww):?>
                        <option value="<?php echo $rowww['bidang'];?>" <?php if ($rowww['bidang']==$bidang){echo "selected";}?>><?php echo $rowww['bidang'];?></option>
                        <?php endforeach;?>
                      </select>
                  </div>
                    <div class="form-group">

										</div>
                    <div class="form-group">
  											<label>File input</label>
  												<input type="file" class="btn btn-default" id="file_rabul" name="file_rabul">
  												<p class="help-block">
  													Masukan file pdf hasil scan.
  												</p>
  										</div>
									</fieldset>
                  <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Submit</button>
								</form>
			  				</div>
      <!-- <div class="modal-footer">
        <input type="submit" class="btn btn-warning" name="action" value="Print" />
        <input type="submit" class="btn btn-info" name="action" value="Export" />
      </div> -->
      </div>
         </form>
      </div>
  </div>
</div>
</div>
<?php } ?>
<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();

    });
    <?php if($this->session->userdata("level") == "User"){ ?>

         $(document).ready(function(){

           $("#btn-add").remove();

         });
         <?php } ?>
    setTimeout(function(){
      $('#msg').remove();
    }, 2000);
</script>
