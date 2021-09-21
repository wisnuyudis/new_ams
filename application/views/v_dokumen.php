<div class="col-md-10">
  <?php echo $this->session->flashdata('msg');?>
    <div class="row">
    <div class="col-md-12">
      <div class="content-box-header panel-heading">
        <div class="panel-title ">View Dokumen</div>

      <!-- <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
      </div> -->
      </div>
      <div class="content-box-large box-with-header">
        Ini view untuk dokumen
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
                            <th class="border-top-0">Nomor Dokumen</th>
                            <th class="border-top-0">Bidang</th>
                            <th class="border-top-0">Jenis Dokumen</th>
                            <th class="border-top-0">Judul Dokumen</th>
                            <th class="border-top-0">Tanggal Dibuat</th>
                            <th class="border-top-0">Publish</th>
                            <!-- <th class="border-top-0">File</th> -->
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        if( ! empty($doc)){
                        foreach($doc->result_array() as $dokumen) {
                          $id = $dokumen['id'];
                          $nomor_dokumen = $dokumen['nomor_dokumen'];
                          $bidang = $dokumen['bidang'];
                          $jenis_dokumen = $dokumen['jenis_dokumen'];
                          $judul_dokumen = $dokumen['judul_dokumen'];
                          $tgl_upload = $dokumen['tgl_upload'];
                          $author = $dokumen['author'];
                          $file_documen = $dokumen['file_documen'];
                     ?>
                      <tr>
                          <th><?=$no++?></th>
                          <th><?php echo $nomor_dokumen;?></th>
                          <th><?php echo $bidang;?></th>
                          <th><?php echo $jenis_dokumen;?></th>
                          <th><?php echo $judul_dokumen;?></th>
                          <th><?php echo $tgl_upload;?></th>
                          <th><?php echo $author;?></th>
                          <th style="text-align:center;">
                              <a id="data_detail" class="btn btn-primary detail" target="_blank" href="<?php echo base_url()?>upload/file_doc/<?=$jenis_dokumen ?>/<?=$file_documen ?>">
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
        <h5 class="modal-title" id="modaladdLabel">Tambah Dokumen</h5>
  </div>

      <div class="modal-body">
        <div class="panel-body">
			  					<form action="<?=base_url('dokumen/tambah_aksi')?>" method="post" enctype="multipart/form-data">
									<fieldset>
										<div class="form-group">
											<label>Nomor Dokumen</label>
											<input class="form-control" id="nomor_dokumen" name="nomor_dokumen" placeholder="Masukan nomor dokumen..." type="text" required>
										</div>
                    <div class="form-group">
											<label>Bidang</label>
												<select class="form-control" id="bidang" name="bidang">
                        <?php foreach($sas->result_array() as $row):?>
                          <option value="<?php echo $row['bidang'];?>"><?php echo $row['bidang'];?></option>
                          <?php endforeach;?>
												</select>
										</div>
                    <div class="form-group">
											<label>Jenis Dokumen</label>
												<select class="form-control" id="jenis_dokumen" name="jenis_dokumen">
                          <?php foreach($jenis->result_array() as $row):?>
                          <option value="<?php echo $row['jenis_surat'];?>"><?php echo $row['jenis_surat'];?></option>
                          <?php endforeach;?>
												</select>
										</div>
                    <div class="form-group">
											<label>Judul Dokumen</label>
											<input class="form-control" id="judul_dokumen" name="judul_dokumen" placeholder="Masukan judul dokumen..." type="text" required>
										</div>
                    <div class="form-group">
  											<label>File input</label>
  												<input type="file" class="btn btn-default" id="file_documen" name="file_documen">
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
<?php
    foreach($doc->result_array() as $dokumen) {
    $id = $dokumen['id'];
    $nomor_dokumen = $dokumen['nomor_dokumen'];
    $jenis_dokumen = $dokumen['jenis_dokumen'];
    $judul_dokumen = $dokumen['judul_dokumen'];
    $tgl_upload = $dokumen['tgl_upload'];
    $author = $dokumen['author'];
    $file_documen = $dokumen['file_documen'];
?>
<!-- ---------------------------MODAL EDIT------------------------- -->
<div class="modal fade" id="modalEdit<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="modalEdit<?php echo $id?>" aria-hidden="true">
<div class="modal-dialog modal-xs">
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
        <h5 class="modal-title" id="modalEditLabel">Edit Dokumen</h5>
  </div>

      <div class="modal-body">
        <div class="panel-body">
			  					<form action="<?=base_url('dokumen/update_aksi')?>" method="post" enctype="multipart/form-data">
									<fieldset>
                  <input value="<?php echo $id?>" id="id" name="id" type="hidden">
                  <input value="<?php echo $file_documen?>" id="file_documen_edit" name="file_documen_edit" type="hidden">
										<div class="form-group">
											<label>Nomor Dokumen</label>
											<input class="form-control" value="<?php echo $nomor_dokumen?>" id="nomor_dokumen" name="nomor_dokumen" type="text" readonly>
										</div>
                    <div class="form-group">
											<label>Bidang</label>
												<select class="form-control" id="bidang" name="bidang">
                        <?php foreach($sas->result_array() as $row):?>
                          <option value="<?php echo $row['bidang'];?>"><?php echo $row['bidang'];?></option>
                          <?php endforeach;?>
												</select>
										</div>
                    <div class="form-group">
											<label>Jenis Dokumen</label>
												<select class="form-control" id="jenis_dokumen" name="jenis_dokumen" required>
                        <?php foreach($jenis->result_array() as $row):?>
                          <option value="<?php echo $row['jenis_surat'];?>"><?php echo $row['jenis_surat'];?></option>
                          <?php endforeach;?>
												</select>
										</div>
                    <div class="form-group">
											<label>Judul Dokumen</label>
											<input class="form-control" id="judul_dokumen" name="judul_dokumen" value="<?php echo $judul_dokumen?>" type="text" required>
										</div>
                    <div class="form-group">
  											<label>File input</label>
  												<input type="file" class="btn btn-default" id="file_documen" name="file_documen">
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
