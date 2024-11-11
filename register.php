<?php
include 'config.php'; // inclure la connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $region = $_POST['region'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Crypter le mot de passe
    $gender = $_POST['gender']; // Sexe (Male, Female, etc.)

    // Vérifier si l'email existe déjà
    $check_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        echo "Cet email est déjà utilisé.";
    } else {
        // Préparer la requête d'insertion
        $sql = $conn->prepare("INSERT INTO users (name, email, phone, region, address, password, sex) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssssss", $name, $email, $phone, $region, $address, $password, $gender);
        header("Location: ./ecommerce/index.html");
        exit();
        
        if ($sql->execute()) {
            header("Location: ./ecommerce/index.html");
            exit();
        } else {
            echo "Erreur lors de l'inscription : " . $conn->error;
        }
    }

    // Fermer la connexion
    $conn->close();
}
?>
