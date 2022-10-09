<div class="row">
	<div class="col-lg-12">
	    <h2>Unit Kerja <small>Data Unit Kerja</small></h2>
	    <ol class="breadcrumb" style="margin-bottom: 10px">
	      <li>Unit Kerja</li>
	      <?php echo @$_GET['act'] == '' ? '<li>Lihat Data</li>' : ''; ?>
	      <?php echo @$_GET['act'] == 'add' ? '<li>Tambah Data</li>' : ''; ?>
	      <?php echo @$_GET['act'] == 'edit' ? '<li>Edit Data</li>' : ''; ?>
	    </ol>
	    <div style="margin-bottom: 10px">
	    	<?php echo @$_GET['act'] == '' ? '<a href="?page=unitkerja&act=add" class="btn btn-success btn-sm"><i class="glyphicon glyphicon glyphicon-plus-sign"></i> Tambah</a>' : '<a href="?page=unitkerja" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon glyphicon glyphicon-arrow-left"></i> Kembali</a>'; ?>
	    </div>
	</div>
</div>

<div class="row">
	<?php
	if(@$_GET['act'] == '') { ?>
		<div class="col-lg-10 col-lg-offset-1">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="dataTables-unitkerja">
					<thead>
						<tr>
							<th>No.</th>
							<th>Jenis Unit Kerja</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Password</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
			            $no = 1;
			            $query = $adm->show_unitkerja();
			            while($data =  $query->fetch_object()) { ?>
			    		<tr>
			                <td><?php echo $no++."."; ?></td>
			                <td><?php echo $data->jenis_uk; ?></td>
			                <td><?php echo $data->nama_uk; ?></td>
			                <td><?php echo $data->username_uk; ?></td>
			                <td><?php echo $data->password_uk; ?></td>
							<td align="center">
								<a href="?page=unitkerja&act=edit&id=<?php echo $data->id_uk; ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
								<a href="?page=unitkerja&act=del&id=<?php echo $data->id_uk; ?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove-circle"></i> Hapus</a>
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
					<?php
				    if($_SERVER['REQUEST_METHOD'] == 'POST') {
				    	echo '<div class="alert alert-danger">';
				    	$adm->add_unitkerja();
				    	echo '</div>';
				    } ?>
				</div>
				<div class="form-group">
					<label for="jenis_uk">Jenis Unit Kerja</label>
					<select class="form-control" name="jenis_uk" id="jenis_uk" required>
					    <option value="">- Pilih Unit Kerja -</option>
					    <option value="Wadek">Wadek</option>
					    <option value="Kaprodi">Kaprodi</option>
					    <option value="Sekprodi">Sekprodi</option>
					    <option value="Lab">Lab</option>
					    <option value="KTU">KTU</option>
					    <option value="Dekan">Dekan</option>
					</select>
				</div>
				<div class="form-group">
	  				<label for="nama">Nama</label>
	 				<input type="text" class="form-control" name="nama" id="nama" required>
				</div>
				<div class="form-group">
					<label for="user">Username</label>
					<input type="text" class="form-control" name="user" id="user" required>
				</div>
				<div class="form-group">
					<label for="pass">Password</label>
					<input type="text" class="form-control" name="pass" id="pass" required>
				</div>
				<button class="btn btn-primary">Tambah</button> 
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
	<?php
	} else if(@$_GET['act'] == 'edit') {
		$query = $adm->show_unitkerja($_GET['id']);
		$data =  $query->fetch_object();
		?>
		<form action="" method="post">
			<div class="col-lg-4 col-lg-offset-4">
				<div class="form-group">
					<?php
				    if($_SERVER['REQUEST_METHOD'] == 'POST') {
				    	echo '<div class="alert alert-danger">';
				    	$adm->edit_unitkerja($_GET['id']);
				    	echo '</div>';
				    } ?>
				</div>
				<div class="form-group">
					<label for="jenis_uk">Jenis Unit Kerja</label>
					<select class="form-control" name="jenis_uk" id="jenis_uk" required>
					    <option value="<?php echo $data->jenis_uk; ?>"><?php echo $data->jenis_uk; ?> *</option>
					    <option value="Wadek">Wadek</option>
					    <option value="Kaprodi">Kaprodi</option>
					    <option value="Sekprodi">Sekprodi</option>
					    <option value="Lab">Lab</option>
					    <option value="KTU">KTU</option>
					    <option value="Dekan">Dekan</option>
					</select>
				</div>
				<div class="form-group">
	  				<label for="nama">Nama</label>
	 				<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data->nama_uk; ?>" required>
				</div>
				<div class="form-group">
					<label for="user">Username</label>
					<input type="text" class="form-control" name="user" id="user" value="<?php echo $data->username_uk; ?>" required>
				</div>
				<div class="form-group">
					<label for="pass">Password</label>
					<input type="text" class="form-control" name="pass" id="pass" value="<?php echo $data->password_uk; ?>" required>
				</div>
				<button class="btn btn-primary">Edit</button> 
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
	<?php
	} else if(@$_GET['act'] == 'del') {
		$adm->del_unitkerja($_GET['id']);
	} ?>
</div>

<script>
$(document).ready(function() {
    var table = $('#dataTables-unitkerja').DataTable();
} );
</script>