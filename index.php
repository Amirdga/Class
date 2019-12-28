<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
    $pdo = new PDO("mysql:host=localhost;dbname=Admin","admin","12345678");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    ?>
    <link href="Style.css" rel="stylesheet">
</head>
<body>
<form method="post" action="">
    <div class="inputBox">
        <input class="inputNomre" type="number" placeholder="نمره" name="nomre" max="20"required>
        <input class="inputName" type="text" placeholder="رشته" name="reshte" required>
        <input class="inputName" type="text" placeholder="پایه" name="paye" required>
        <input class="inputName" type="text" placeholder="نام خانوادگی" name="lastName" required>
        <input class="inputName" type="text" placeholder="نام" name="firstName" required="fff">
        <input class="submitName" type="submit" value="ارسال" name="submit">
        <?php
        if (isset($_POST["submit"])){
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $Paye = $_POST["paye"];
            $Reshte = $_POST["reshte"];
            $nomre = $_POST["nomre"];


            $sql = "INSERT INTO `Students`(`Name1`,`Name2`,`Paye`,`Reshte`,`Nomre`) VALUES (:firstName , :lastName , :paye, :reshte , :nomre)";
            $stmt = $pdo->prepare($sql);
            $stmt ->bindParam(":firstName",$firstName);
            $stmt ->bindParam(":lastName",$lastName);
            $stmt ->bindParam(":paye",$Paye);
            $stmt ->bindParam(":reshte",$Reshte);
            $stmt ->bindParam(":nomre",$nomre);


            $stmt -> execute();
            $count =$stmt->rowCount();
            if ($count == 1){
                $response = "با موفقیت درج شد!";
            }else{
                $response = "خطا در درج!";
            }
        }

        if (isset($response)){
            echo $response;
        }


        ?>
    </div>
    <table width="100%" style="margin-top: 30px ;text-align: center; direction: rtl;"border="1">
        <tr>
            <td class="table">نام</td>
            <td class="table">نام خانوادگی</td>
            <td class="table">پایه</td>
            <td class="table">رشته</td>
            <td class="table">نمره</td>
            <td class="table">وضعیت</td>
        </tr>
        <?php
        $query = $pdo->query("SELECT * FROM `Students`");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $value){
            ?>
            <tr>
                <td class="table2"><?php echo $value['Name1'] ?></td>
                <td class="table2"><?php echo $value['Name2'] ?></td>
                <td class="table2"><?php echo $value['Paye'] ?></td>
                <td class="table2"><?php echo $value['Reshte'] ?></td>
                <td class="table2"><?php echo $value['Nomre'] ?></td>
                <?php
                if ($value['Nomre']<10){
                    ?>
                    <td class="table3"><?php echo 'شما رد شدید' ?></td>
                    <?php
                }else{?>
                    <td class="table4"><?php echo 'شما قبول شدید' ?></td>
                    <?php
                }
                ?>

            </tr>

        <?php } ?>
    </table>



</form>

</body>
</html>