<div class="col-md-10">
  <?php echo $this->session->flashdata('msg');?>
    <div class="row">
    <div class="col-md-12">
      <div class="content-box-header panel-heading">
        <div class="panel-title ">View Edaran</div>

      <!-- <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
      </div> -->
      </div>
      <div class="content-box-large box-with-header">
        Ini view untuk Surat Edaran
        <div class="float-right">
            <button type="button" id="btn-add" class="btn btn-success" data-toggle="modal" data-target="#modaladd">
             <i class="fa fa-plus"></i>&nbsp;Add</button>
             <br/>
             <br/>
        </div>
        <div class="table-responsive">
                <table class="table" id="tabel-data">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Nomor Surat</th>
                            <th class="border-top-0">Isi Surat</th>
                            <th class="border-top-0">Publish</th>
                            <th class="border-top-0">Tanggal Publish</th>
                            <!-- <th class="border-top-0">Author</th> -->
                            <!-- <th class="border-top-0">File</th> -->
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        if( ! empty($se)){
                        foreach($se->result_array() as $surat) {
                          $id = $surat['id'];
                          $nomor_surat = $surat['nomor_surat'];
                          $isi_surat = $surat['isi_surat'];
                          $publish = $surat['publish'];
                          $tgl_publish = $surat['tgl_publish'];
                          $file_surat = $surat['file_surat'];
                     ?>
                      <tr>
                          <th><?=$no++?></th>
                          <th><?php echo $nomor_surat;?></th>
                          <th><?php echo $isi_surat;?></th>
                          <th><?php echo $publish;?></th>
                          <th><?php echo $tgl_publish;?></th>
                          <th style="text-align:center;">
                              <a id="data_detail" class="btn btn-primary detail" target="_blank" href="<?php echo base_url()?>upload/file_surat/<?=$file_surat ?>">
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
        <h5 class="modal-title" id="modaladdLabel">Tambah Surat Edaran</h5>
  </div>

      <div class="modal-body">
        <div class="panel-body">
			  					<form action="<?=base_url('edaran/tambah_aksi')?>" method="post" enctype="multipart/form-data">
									<fieldset>
										<div class="form-group">
											<label>Nomor Surat</label>
											<input class="form-control" id="nomor_surat" name="nomor_surat" placeholder="Masukan nomor surat..." type="text" required>
										</div>
                    <div class="form-group">
											<label>Isi Surat</label>
											<input class="form-control" id="isi_surat" name="isi_surat" placeholder="Masukan isi surat..." type="text" required>
										</div>
                    <div class="form-group">
  											<label>File input</label>
  												<input type="file" class="btn btn-default" id="file_surat" name="file_surat">
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
  foreach($se->result_array() as $surat) {
    $id = $surat['id'];
    $nomor_surat = $surat['nomor_surat'];
    $isi_surat = $surat['isi_surat'];
    $publish = $surat['publish'];
    $tgl_publish = $surat['tgl_publish'];
    $file_surat = $surat['file_surat'];
?>
<div class="modal fade" id="modalEdit<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="modalEdit<?php echo $id?>" aria-hidden="true">
<div class="modal-dialog modal-xs">
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
        <h5 class="modal-title" id="modalEditLabel">Edit Surat Edaran</h5>
  </div>

      <div class="modal-body">
        <div class="panel-body">
			  					<form action="<?=base_url('edaran/update_aksi')?>" method="post" enctype="multipart/form-data">
									<fieldset>
                  <input type="hidden" id="id" name="id" value="<?php echo $id?>">
                  <input type="hidden" id="file_edit_surat" name="file_edit_surat" value="<?php echo $file_surat?>">
										<div class="form-group">
											<label>Nomor Surat</label>
											<input class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo $nomor_surat ?>" type="text" readonly>
										</div>
                    <div class="form-group">
											<label>Isi Surat</label>
											<input class="form-control" id="isi_surat" name="isi_surat" value="<?php echo $isi_surat ?>" type="text" required>
										</div>
                    <div class="form-group">
  											<label>File input</label>
  												<input type="file" class="btn btn-default" id="file_surat" name="file_surat">
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
