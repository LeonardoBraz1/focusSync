<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$folderPath = 'sistema/assets/images/icons'; // Especifique o caminho da pasta

$files = glob($folderPath . '/*'); // Obtém todos os arquivos e diretórios da pasta

foreach ($files as $file) {
    echo $file . "<br>"; // Exibe cada caminho de arquivo/diretório
}
?>
</body>
</html>