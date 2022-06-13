<h5> List Data User</h5>
<table border=1 class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Username</th>
			<th>Jabatan</th>
			<th>Alamat</th>
			<th>No Telp</th>
			
		</tr>
	</thead>
	
	<tbody>
		<?php foreach($data as $index => $value) { ?>
			<tr>
				<td><?php echo $index+1 ?></td>
				<td><?php echo $value->nama_petugas; ?></td>
				<td><?php echo $value->username_petugas; ?></td>
				<td><?php echo $value->jabatan_petugas; ?></td>
				<td><?php echo $value->alamat_petugas; ?></td>
				<td><?php echo $value->no_telp_petugas; ?></td>
				
			</tr>
		<?php } ?>
	</tbody>
</table>
                            
