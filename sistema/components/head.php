<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Open Graph Meta-->
    <title>teste</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../../assets/css/main.css" />
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="../../assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="../../assets/MDB5-STANDARD/css/mdb.min.css" rel="stylesheet" />
    
    <!-- Inclua a referência ao arquivo do Service Worker
    <script>
        $(document).ready(function() {
            $('#cachePermissionButtonYes').click(function() {
                // O usuário aceitou, registra o Service Worker
                registerServiceWorker();
                $("#cachePermissionModal").modal("hide");
            });

            $('#cachePermissionButtonNo').click(function() {
                $("#cachePermissionModal").modal("hide");
            });

            // Verifica se o Service Worker já está registrado no localStorage
            if ('serviceWorker' in navigator && navigator.serviceWorker.controller) {
                // Service Worker já registrado, esconde o modal
                $('#cachePermissionModal').modal('hide');
            } else if (localStorage.getItem('serviceWorkerRegistered') !== 'true') {
                // Service Worker não registrado e o flag não está definido, exibe o modal
                $('#cachePermissionModal').modal('show');
            }
        });

        function registerServiceWorker() {
            navigator.serviceWorker.register('../../assets/js/service-worker.js')
                .then(function(registration) {
                    console.log('Service Worker registrado com sucesso:', registration.scope);
                    localStorage.setItem('serviceWorkerRegistered', 'true');
                })
                .catch(function(error) {
                    console.log('Falha ao registrar o Service Worker:', error);
                });
        }
    </script>


    <?php
    // Define a duração do cache para 1 hora
    $cacheDuration = 3600;

    // Define a data e hora de expiração do cache
    $expires = gmdate('D, d M Y H:i:s', time() + $cacheDuration) . ' GMT';

    // Define o cabeçalho Cache-Control para indicar o tempo de vida do cache
    header('Cache-Control: max-age=' . $cacheDuration);

    header('Expires: ' . $expires);
    ?> -->
</head>