<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/stylesheet.css" type="text/css">
        <link rel="icon" href="assets/icone.png" type="image/png">
        <?php require "main.php"; ?>
        <title>Gerenciador de Bancos Financeiros</title>
    </head>
    <body>
        <div class="box">
            <form action="criarBancos.php" method="POST">
                <fieldset>
                    <legend><b>Banco Financeiro</b></legend>
                    <br>

                    <div class="inputBox">
                        <input type="text" name="nomeCliente" class="inputUser" required>
                        <label class="labelInput">Nome do cliente</label>
                    </div>
                    <br><br>
                    <input type="submit" name="submit" id="submit"><br><br>
                </fieldset>
            </form>
                <?php
                    transferir('123', '321', 2);
                ?>
        </div>
    </body>
</html>
    
    
