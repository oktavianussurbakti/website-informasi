<?php 
     // mengambil data artikel dengan kode paling besar
      include '../../config/database.php';
      $query = mysqli_query($kon, "SELECT max(id_artikel) as kodeTerbesar FROM artikel");
      $data = mysqli_fetch_array($query);
      $id_artikel = $data['kodeTerbesar'];
      $id_artikel++;
      $huruf = "A";
      $kodeartikel = $huruf . sprintf("%04s", $id_artikel);

?>
<form action="artikel/tambah-artikel.php" method="post" enctype="multipart/form-data">
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Kode:</label>
                <h3><?php echo $kodeartikel; ?></h3>
                <input name="kode_artikel" value="<?php echo $kodeartikel; ?>" type="hidden" class="form-control">
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Judul Artikel:</label>
                <input name="judul_artikel" type="text" class="form-control" placeholder="Masukan nama artikel" required>
            </div>
        </div>
    </div>
    <!-- rows -->   
    <div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Isi Artikel:</label>
            <textarea name="isi_artikel" class="form-control ckeditor"  id="ckeditor" rows="5" ></textarea>
        </div>
    </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div id="msg"></div>
                <label>Gambar:</label>
                <input type="file" name="gambar" class="file" >
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                        <div class="input-group-append">
                                <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                        </div>
                    </div>
                <img src="gambar_default.png" id="preview" class="img-thumbnail">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori" class="form-control">
                <?php
                    echo $id_kategori=$_POST['kategori'];
                    include '../../config/database.php';
                    $sql="select * from kategori where id_kategori='$id_kategori' limit 1";
                    $hasil=mysqli_query($kon,$sql);
                    while ($data = mysqli_fetch_array($hasil)):
                ?>
                    <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>

    <!-- rows -->   
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <button type="submit" name="publish" class="btn btn-success">Publish</button>
                <button type="submit" name="simpan_konsep" class="btn btn-warning">Simpan Konsep</button>
            </div>
    
        </div>
   
    </div>   
</form>
<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>
<script>
    $(document).on("click", "#pilih_gambar", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
    });
</script>