<div id="kiri">

	<?php 
		
		echo kategori($kategori_id);
	
	?>
	
</div>

<div id="kanan">
	
    <div id="slides">
	
		<?php 
		
			$queryBanner = mysqli_query($koneksi, "SELECT * FROM banner WHERE status='on' ORDER BY banner_id DESC LIMIT 3");
			while($rowBanner=mysqli_fetch_assoc($queryBanner)){
				echo "<a href='".BASE_URL."$rowBanner[link]'><img src='".BASE_URL."images/slide/$rowBanner[gambar]' /></a>";
			}
		?>
	
	</div>	
	
	
	<div id="frame-barang">
	
		<ul>
			<?php
				
				if($kategori_id){
					$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE status='on' AND kategori_id='$kategori_id' ORDER BY rand() DESC LIMIT 9");
				}else{
					$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE status='on' ORDER BY rand() DESC LIMIT 9");
				}
				
				$no=1;
				while($row=mysqli_fetch_assoc($query)){
					
					$style=false;
					if($no == 3){
						$style="style='margin-right:0px'";
						$no=0;
					}
					
					// determine image source, fallback to logo if file missing
					$localImg = $_SERVER['DOCUMENT_ROOT'].'/weshop/images/barang/'. $row['gambar'];
					if(!empty($row['gambar']) && file_exists($localImg) && is_file($localImg)){
						$imgSrc = BASE_URL.'images/barang/'.$row['gambar'];
					}else{
						$imgSrc = BASE_URL.'images/logo.png';
					}
					
					echo "<li $style>
							<p class='price'>".rupiah($row['harga'])."</p>
							<a href='".BASE_URL."index.php?page=detail&barang_id=$row[barang_id]'>
								<img src='".$imgSrc."' alt='".htmlspecialchars($row['nama_barang'], ENT_QUOTES)."' />
							</a>
							<div class='keterangan-gambar'>
								<p><a href='".BASE_URL."index.php?page=detail&barang_id=$row[barang_id]'>$row[nama_barang]</a></p>
								<span>Stok : $row[stok]</span>
							</div>
							<div class='button-add-cart'>
								<a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]'>+ add to cart</a>
							</div>";
					
					$no++;
				}
			
			?>
		</ul>
	
	</div>

</div>