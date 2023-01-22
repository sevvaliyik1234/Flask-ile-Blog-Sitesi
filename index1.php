<!--index.php-->
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>İndex</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<?php
session_start(); 
if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
    
    $kadi = $_SESSION["kadi"];
} else {
    header("location:login.php");
}
?>
<div class="container">
    
    <h1>Merhaba <?php echo $kadi; ?></h1>

    
    <a href="register.php" class="btn btn-primary">Yeni Kullanıcı</a>
    <a href="logout.php" class="btn btn-danger">Çıkış</a> <br><br>

    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Kullanıcı Adı</th>
                <th>İşlem</th>
            </tr>
            <?php
            include("inc/vt.php");
            
            $sorgu = $baglanti->query("select * from kullanicilar");

           
            while ($sonuc = $sorgu->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $sonuc["kadi"] ?></td>
                    <td>
                        
                        <a href="userEdit.php?id=<?php echo $sonuc["id"] ?>"><img src="image/duzenle.png"/></a>
                        <a href="userDelete.php?id=<?php echo $sonuc["id"] ?>"><img src="image/sil.png"/></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>