<div class="row">
	<div class="col-lg-12">
	    <h2>Bidang Garapan <small>Data Bidang Garapan</small></h2>
	    <ol class="breadcrumb" style="margin-bottom: 10px">
	      <li>Bidang Garapan</li>
	      <?php echo @$_GET['act'] == '' ? '<li>Lihat Data</li>' : ''; ?>
	      <?php echo @$_GET['act'] == 'add' ? '<li>Tambah Data</li>' : ''; ?>
	      <?php echo @$_GET['act'] == 'edit' ? '<li>Edit Data</li>' : ''; ?>
	    </ol>
	    <div style="margin-bottom: 10px">
	    	<?php echo @$_GET['act'] == '' ? '<a href="?page=bidanggarapan&act=add" class="btn btn-success btn-sm"><i class="glyphicon glyphicon glyphicon-plus-sign"></i> Tambah</a>' : '<a href="?page=bidanggarapan" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon glyphicon glyphicon-arrow-left"></i> Kembali</a>'; ?>
	    </div>
	</div>
</div>

<div class="row">
	<?php
	if(@$_GET['act'] == '') { ?>
		<div class="col-lg-8 col-lg-offset-2">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="dataTables-bidanggarapan">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Bidang Garapan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
			            $no = 1;
			            $query = $adm->show_bidanggarapan();
			            while($data =  $query->fetch_object()) { ?>
				    		<tr>
				                <td><?php echo $no++."."; ?></td>
				                <td><?php echo $data->nama_bidang; ?></td>
								<td align="center">
									<a href="?page=bidanggarapan&act=edit&id=<?php echo $data->id_bidang; ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
									<a href="?page=bidanggarapan&act=del&id=<?php echo $data->id_bidang; ?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove-circle"></i> Hapus</a>
								</td>
							</tr>
						<?php
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php
	} else if(@$_GET['act'] == 'add') { ?>
		<form action="" method="post">
			<div class="col-lg-4 col-lg-offset-4">			
				<div class="form-group">
	  				<label for="nama">Nama Bidang Garapan</label>
	 				<input type="text" class="form-control" name="nama" id="nama" placeholder="Ex. Pendidikan & Pengajaran" required>
				</div>
				<button class="btn btn-primary">Tambah</button> 
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
		<?php
	    if($_SERVER['REQUEST_METHOD'] == 'POST') {
	    	$adm->add_bidanggarapan();
	    }
	} else if(@$_GET['act'] == 'edit') {
		$query = $adm->show_bidanggarapan($_GET['id']);
		$data =  $query->fetch_object(); ?>
		<form action="" method="post">
			<div class="col-lg-4 col-lg-offset-4">
				<div class="form-group">
	  				<label for="nama">Nama</label>
	 				<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data->nama_bidang; ?>" required>
				</div>
				<button class="btn btn-primary">Edit</button> 
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
		<?php
	    if($_SERVER['REQUEST_METHOD'] == 'POST') {
	    	$adm->edit_bidanggarapan($_GET['id']);
	    }
	} else if(@$_GET['act'] == 'del') {
		$adm->del_bidanggarapan($_GET['id']);
	} ?>
</div>

<script>
$(document).ready(function() {
    var table = $('#dataTables-bidanggarapan').DataTable();
} );
</script>