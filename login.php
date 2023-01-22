<!--Login.php-->
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <title>Giriş</title>
    <style>
        .kutu {
            margin-top: 40px
        }
    </style>
</head>
<body>
<?php
session_start(); 
include("inc/vt.php"); 


if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
    header("location:index1.php");
} 
else if (isset($_COOKIE["cerez"])) {
    
    $sorgu = $baglanti->query("select kadi from kullanicilar");

    
    while ($sonuc = $sorgu->fetch_assoc()) {
        
        if ($_COOKIE["cerez"] == md5("aa" . $sonuc['kadi'] . "bb")) {

           
            $_SESSION["Oturum"] = "6789";
            $_SESSION["kadi"] = $sonuc['kadi'];

           
            header("location:index1.php");
        }
    }
}

if ($_POST) {
    $txtKadi = $_POST["txtKadi"]; 
    $txtParola = $_POST["txtParola"]; 
}
?>

<form id="form1" method="post">
    <div class="row align-content-center justify-content-center ">
        <div class="col-md-3 kutu">
            <h3 class="text-center">Giriş Ekranı</h3>
            <table class="table">
                <tr>
                    <td>
                        
                        <input type="text" ID="txtKadi" name="txtKadi" class="form-control" placeholder="Kullanıcı adı"
                               value='<?php echo @$txtKadi ?>'/>

                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" ID="txtParola" name="txtParola" class="form-control" placeholder="Parola"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input type="checkbox" ID="ckbHatirla" name="ckbHatirla"/>
                            Beni hatırla
                        </label>
                        <br>
                        <?php
                        
                        if ($_POST) {
                            
                            $sorgu = $baglanti->query("select parola from kullanicilar where kadi='$txtKadi'");
                            $sonuc = $sorgu->fetch_assoc();

                            
                            if (md5("56" . $txtParola . "23") == $sonuc["parola"]) {
                                $_SESSION["Oturum"] = "6789"; 
                                $_SESSION["kadi"] = $txtKadi;

                                
                                if (isset($_POST["ckbHatirla"])) {
                                    setcookie("cerez", md5("aa" . $txtKadi . "bb"), time() + (60 * 60 * 24 * 7));
                                }
                                header("location:index1.php");
                            } else {
                                
                                echo "Kullanıcı adı veya parola yanlış!";
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <input type="submit" class="btn btn-primary btn-block" ID="btnGiris" value="Giriş"/>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
</body>
</html>