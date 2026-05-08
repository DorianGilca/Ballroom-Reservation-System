<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ballroomdb");

if ($conn->connect_error) { die("Eroare conexiune: " . $conn->connect_error); }

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preluam datele din formular
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $adresa = $_POST['adresa'];
    $parola = $_POST['parola']; // O folosim doar ca verificare simpla sau o salvam

    // Verificam daca acest email exista deja in baza de date
    $check = $conn->query("SELECT * FROM Client WHERE email = '$email'");
    
    if ($check->num_rows > 0) {
        $row = $check->fetch_assoc();
        if ($row['parola'] == $parola) {
            $_SESSION['client_id'] = $row['client_id'];
            $_SESSION['nume_client'] = $row['nume'] . " " . $row['prenume'];
            header("Location: dashboard.php");
            exit();
        } else {
            $mesaj = "Ai deja cont, dar parola este greșită!";
        }
    } else {
        $sql = "INSERT INTO Client (nume, prenume, telefon, email, adresa, parola) 
                VALUES ('$nume', '$prenume', '$telefon', '$email', '$adresa', '$parola')";
        
        if ($conn->query($sql) === TRUE) {
            // Luam ID ul noului client creat
            $_SESSION['client_id'] = $conn->insert_id;
            $_SESSION['nume_client'] = $nume . " " . $prenume;
            header("Location: dashboard.php");
            exit();
        } else {
            $mesaj = "Eroare la baza de date: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Acces Ballroom</title>
    <style>
        body {
            margin: 0; font-family: 'Segoe UI', sans-serif;
            background: url('https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=2068&auto=format&fit=crop') no-repeat center center/cover;
            height: 100vh; display: flex; justify-content: center; align-items: center;
        }
        body::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6); z-index: 1;
        }
        .login-card {
            position: relative; z-index: 2;
            background: rgba(255, 255, 255, 0.95); padding: 40px; width: 350px;
            border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); text-align: center;
        }
        h2 { color: #333; margin-bottom: 20px; text-transform: uppercase; }
        input {
            width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ddd;
            border-radius: 5px; box-sizing: border-box;
        }
        button {
            width: 100%; padding: 12px; margin-top: 15px;
            background: #d4af37; color: white; border: none; font-weight: bold;
            border-radius: 5px; cursor: pointer; transition: 0.3s;
        }
        button:hover { background: #b89628; }
        .info { font-size: 12px; color: #666; margin-bottom: 15px; }
        .error { color: red; margin-top: 10px; font-size: 14px; }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Acces Rezervări</h2>
        <p class="info">Completează datele pentru a intra în platformă. Dacă ești nou, te vom înregistra automat.</p>
        
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="parola" placeholder="Parola (pentru acces)" required>
            
            <input type="text" name="nume" placeholder="Nume" required>
            <input type="text" name="prenume" placeholder="Prenume" required>
            <input type="text" name="telefon" placeholder="Telefon" required>
            <input type="text" name="adresa" placeholder="Oraș" required>
            
            <button type="submit">Intră în Cont</button>
            <?php if($mesaj): ?><div class="error"><?php echo $mesaj; ?></div><?php endif; ?>
        </form>
    </div>

</body>
</html>
