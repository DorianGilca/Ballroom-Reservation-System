<?php
session_start();

if (!isset($_SESSION['client_id'])) { header("Location: login.php"); exit(); }

$conn = new mysqli("localhost", "root", "", "ballroomdb");
if ($conn->connect_error) { die("Eroare: " . $conn->connect_error); }

$client_id = $_SESSION['client_id'];

// FILTRU 

$data_filtrare = "2000-01-01"; 
$text_afisat = "Toata Perioada";

if (isset($_POST['aplica_filtru_data'])) {
    $data_filtrare = $_POST['data_start'];
    $text_afisat = "Dupa data: " . $data_filtrare;
}

//

// 1. INSERT eveniment
if (isset($_POST['adauga_rezervare'])) {
    $sala_id = $_POST['sala_id'];
    $meniu_id = $_POST['meniu_id'];
    $data = $_POST['data_eveniment'];
    $pers = $_POST['nr_persoane'];
    $tip = $_POST['tip_eveniment'];
    $conn->query("INSERT INTO Eveniment (client_id, sala_id, meniu_id, tip_eveniment, data_eveniment, numar_persoane, status) 
                  VALUES ($client_id, $sala_id, $meniu_id, '$tip', '$data', $pers, 'In Asteptare')");
    header("Location: dashboard.php"); exit();
}

// 2. DELETE rezervare
if (isset($_POST['sterge_rezervare'])) {
    $id_de_sters = $_POST['id_eveniment'];
    $conn->query("DELETE FROM Plata WHERE eveniment_id = $id_de_sters");
    $conn->query("DELETE FROM Eveniment WHERE eveniment_id = $id_de_sters");
    header("Location: dashboard.php"); exit();
}

// 3. UPDATE eveniment
if (isset($_POST['actualizeaza_nr'])) {
    $id_ev = $_POST['id_eveniment_update'];
    $nr_nou = $_POST['nr_persoane_nou'];
    $conn->query("UPDATE Eveniment SET numar_persoane = $nr_nou WHERE eveniment_id = $id_ev");
    header("Location: dashboard.php"); exit();
}

// 4. UPDATE profil
if (isset($_POST['actualizeaza_profil'])) {
    $tel_nou = $_POST['telefon_nou'];
    $conn->query("UPDATE Client SET telefon = '$tel_nou' WHERE client_id = $client_id");
    echo "<script>alert('Telefon actualizat!'); window.location.href='dashboard.php';</script>";
}

// 5. DELETE TOTAL
if (isset($_POST['sterge_cont_client'])) {
    $conn->query("DELETE FROM Plata WHERE eveniment_id IN (SELECT eveniment_id FROM Eveniment WHERE client_id = $client_id)");
    $conn->query("DELETE FROM Eveniment WHERE client_id = $client_id");
    $conn->query("DELETE FROM Client WHERE client_id = $client_id");
    session_destroy();
    header("Location: login.php"); exit();
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Luxury</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0; font-family: 'Poppins', sans-serif;
            background: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=2070&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover; color: white; padding-bottom: 50px;
        }
        body::before {
            content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(10, 15, 30, 0.85); z-index: -1;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); padding: 20px 50px;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        .logo { font-size: 24px; font-weight: 600; color: #d4af37; text-transform: uppercase; letter-spacing: 2px; text-shadow: 0 0 10px rgba(212, 175, 55, 0.5); }
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        
        .glass-panel {
            background: rgba(255, 255, 255, 0.07); backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 30px;
            margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); transition: transform 0.3s ease;
        }
        .glass-panel:hover { transform: translateY(-5px); border-color: rgba(212, 175, 55, 0.3); }
        h2 { margin-top: 0; color: #d4af37; font-weight: 300; border-bottom: 1px solid rgba(212, 175, 55, 0.3); padding-bottom: 15px; letter-spacing: 1px; }

        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; margin-bottom: 40px; }
        .stat-card {
            background: linear-gradient(145deg, rgba(255,255,255,0.1), rgba(255,255,255,0.02));
            padding: 25px; border-radius: 15px; text-align: center;
            border: 1px solid rgba(255,255,255,0.05); position: relative; overflow: hidden;
        }
        .stat-card::after { content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; }
        .blue::after { background: #00f2ff; box-shadow: 0 0 10px #00f2ff; }
        .gold::after { background: #ffd700; box-shadow: 0 0 10px #ffd700; }
        .green::after { background: #00ff87; box-shadow: 0 0 10px #00ff87; }
        .purple::after { background: #d500f9; box-shadow: 0 0 10px #d500f9; }
        .stat-card h3 { margin: 10px 0; font-size: 36px; font-weight: 600; color: white; }
        .stat-card p { color: #aaa; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; }

        input, select {
            width: 100%; padding: 12px 15px; background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; color: white;
            font-family: 'Poppins', sans-serif; box-sizing: border-box; transition: 0.3s;
        }
        input:focus, select:focus { border-color: #d4af37; outline: none; background: rgba(0, 0, 0, 0.5); }
        button {
            padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer;
            font-weight: 600; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; color: white;
        }
        .btn-glow { background: linear-gradient(45deg, #d4af37, #b8860b); box-shadow: 0 0 15px rgba(212, 175, 55, 0.4); }
        .btn-glow:hover { transform: scale(1.05); box-shadow: 0 0 25px rgba(212, 175, 55, 0.6); }
        
        .form-row { display: flex; gap: 20px; flex-wrap: wrap; align-items: flex-end; }
        .form-group { flex: 1; min-width: 180px; }
        label { display: block; margin-bottom: 8px; color: #ccc; font-size: 13px; }

        table { width: 100%; border-collapse: separate; border-spacing: 0 10px; margin-top: 10px; }
        th { text-align: left; padding: 15px; color: #888; font-size: 12px; text-transform: uppercase; }
        td { padding: 15px; background: rgba(255,255,255,0.03); vertical-align: middle; }
        td:first-child { border-radius: 10px 0 0 10px; } td:last-child { border-radius: 0 10px 10px 0; }
        
        .info-layout { display: grid; grid-template-columns: 1fr 2fr; gap: 30px; }
        .logout-link { color: #e74c3c; text-decoration: none; font-size: 14px; font-weight: bold; padding: 8px 20px; border: 1px solid #e74c3c; border-radius: 30px; }
        .btn-action { padding: 8px 15px; font-size: 12px; width: auto; }
        .save { background: #27ae60; } .delete { background: #e74c3c; }
        
        
        .filter-container {
            background: rgba(255,255,255,0.1); padding: 15px; border-radius: 15px;
            margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo">✦ Ballroom Exclusive</div>
        <div style="display:flex; align-items:center; gap:20px;">
            <span style="font-size:14px; color:#aaa;">Logat ca: <strong style="color:white;"><?php echo $_SESSION['nume_client']; ?></strong></span>
            <a href="login.php" class="logout-link">Ieșire</a>
        </div>
    </div>

    <div class="container">

        <div class="filter-container">
            <h3 style="margin:0; color: #d4af37;">📊 Rapoarte Statistice</h3>
            <form method="POST" style="display:flex; gap:10px; align-items:center;">
                <label style="margin:0; margin-right:5px;">Arată evenimente după:</label>
                <input type="date" name="data_start" value="<?php echo ($data_filtrare == '2000-01-01') ? '' : $data_filtrare; ?>" style="width: auto;">
                <button type="submit" name="aplica_filtru_data" class="btn-glow" style="padding: 10px 20px; font-size:12px;">Aplică Filtru</button>
            </form>
        </div>
        <p style="text-align: right; font-size: 12px; color: #aaa; margin-top: -15px; margin-bottom: 20px;">Filtru activ: <?php echo $text_afisat; ?></p>


        <div class="stats-grid">
            
            <div class="stat-card blue">
                <?php
                //SUm
                $sql1 = "SELECT SUM(E.numar_persoane * M.pret_persoana) as val 
                         FROM Eveniment E 
                         JOIN Meniu M ON E.meniu_id = M.meniu_id 
                         WHERE E.client_id = $client_id AND E.data_eveniment >= '$data_filtrare'"; //
                
                $r1 = $conn->query($sql1)->fetch_assoc();
                echo "<h3>" . number_format($r1['val'] ?? 0) . " <span style='font-size:16px'>RON</span></h3>";
                ?>
                <p>💎 Valoare (După Data Aleasă)</p>
            </div>
            
            <div class="stat-card gold">
                <?php
                // MAX
                $sql2 = "SELECT MAX(numar_persoane) as m 
                         FROM Eveniment 
                         WHERE client_id = $client_id AND data_eveniment >= '$data_filtrare'"; //
                         
                $r2 = $conn->query($sql2)->fetch_assoc();
                echo "<h3>" . ($r2['m'] ?? 0) . "</h3>";
                ?>
                <p>🏆 Record Invitați</p>
            </div>
            
            <div class="stat-card green">
                <?php
                // AVG
                $sql3 = "SELECT AVG(numar_persoane) as a 
                         FROM Eveniment 
                         WHERE client_id = $client_id AND data_eveniment >= '$data_filtrare'"; //
                         
                $r3 = $conn->query($sql3)->fetch_assoc();
                echo "<h3>" . round($r3['a'] ?? 0) . "</h3>";
                ?>
                <p>📊 Medie Invitați</p>
            </div>
            
            <div class="stat-card purple">
                <?php
                // 4. MODIFICAT: Numara doar evenimentele cu > 200 persoane (folosind subcerere pentru cerinta)
                $sql4 = "SELECT COUNT(*) as nr 
                         FROM Eveniment 
                         WHERE client_id=$client_id 
                         AND data_eveniment >= '$data_filtrare'
                         AND eveniment_id IN (SELECT eveniment_id FROM Eveniment WHERE numar_persoane > 200)";
                         
                $r4 = $conn->query($sql4)->fetch_assoc();
                echo "<h3>" . ($r4['nr'] ?? 0) . "</h3>";
                ?>
                <p>🚀 Evenimente Mari (>200)</p>
            </div>
        </div>

        <div class="info-layout">
            <div class="glass-panel">
                <h2>👤 Profilul Meu</h2>
                <?php $client = $conn->query("SELECT * FROM Client WHERE client_id = $client_id")->fetch_assoc(); ?>
                <form method="POST">
                    <label>Nume Client (Fix)</label>
                    <input type="text" value="<?php echo $client['nume'] . ' ' . $client['prenume']; ?>" disabled style="opacity:0.7;">
                    <div style="margin-top:15px;">
                        <label>Telefon (Editabil)</label>
                        <input type="text" name="telefon_nou" value="<?php echo $client['telefon']; ?>">
                    </div>
                    <button type="submit" name="actualizeaza_profil" class="btn-glow" style="width:100%; margin-top:20px; background: linear-gradient(45deg, #2980b9, #2c3e50);">Salvează Modificări</button>
                </form>
                <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 25px 0;">
                <form method="POST" onsubmit="return confirm('ATENȚIE! Sigur vrei să ștergi contul?');">
                    <label style="color: #e74c3c; margin-bottom: 10px; display:block;">Zona Periculoasă</label>
                    <button type="submit" name="sterge_cont_client" class="btn-glow" style="width:100%; background: linear-gradient(45deg, #c0392b, #8e44ad); box-shadow: 0 0 15px rgba(231, 76, 60, 0.4);">⚠️ Șterge Contul</button>
                </form>
            </div>

            <div class="glass-panel">
                <h2>📋 Catalog Exclusiv</h2>
                <div style="display:flex; gap:30px;">
                    <div style="flex:1;">
                        <h4 style="color:#00f2ff; margin-bottom:10px;">Săli Disponibile</h4>
                        <ul><?php $s = $conn->query("SELECT denumire, capacitate FROM Sala"); while($row=$s->fetch_assoc()) echo "<li>✦ ".$row['denumire']." <span style='float:right; opacity:0.6'>Cap: ".$row['capacitate']."</span></li>"; ?></ul>
                    </div>
                    <div style="flex:1;">
                        <h4 style="color:#ffd700; margin-bottom:10px;">Selecție Meniuri</h4>
                        <ul><?php $m = $conn->query("SELECT denumire, pret_persoana FROM Meniu"); while($row=$m->fetch_assoc()) echo "<li>● ".$row['denumire']." <span style='float:right; opacity:0.6'>".$row['pret_persoana']." RON</span></li>"; ?></ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-panel">
            <h2>➕ Planifică un Eveniment Nou</h2>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group"><label>Locația</label><select name="sala_id"><?php $s=$conn->query("SELECT * FROM Sala"); while($r=$s->fetch_assoc()) echo "<option style='color:black' value='".$r['sala_id']."'>".$r['denumire']."</option>"; ?></select></div>
                    <div class="form-group"><label>Meniul</label><select name="meniu_id"><?php $m=$conn->query("SELECT * FROM Meniu"); while($r=$m->fetch_assoc()) echo "<option style='color:black' value='".$r['meniu_id']."'>".$r['denumire']."</option>"; ?></select></div>
                    <div class="form-group"><label>Tip</label><select name="tip_eveniment"><option style='color:black'>Nunta</option><option style='color:black'>Botez</option><option style='color:black'>Gala</option></select></div>
                    <div class="form-group"><label>Data</label><input type="date" name="data_eveniment" required></div>
                    <div class="form-group"><label>Nr. Persoane</label><input type="number" name="nr_persoane" placeholder="ex: 150" required></div>
                    <div class="form-group" style="flex:0;"><label>&nbsp;</label><button type="submit" name="adauga_rezervare" class="btn-glow">Rezervă</button></div>
                </div>
            </form>
        </div>

        <div class="glass-panel">
            <h2>📅 Rezervările Mele Active</h2>
            <table>
                <thead><tr><th>Eveniment</th><th>Locație</th><th>Meniu</th><th>Status</th><th>Invitați</th><th style="text-align:right">Acțiuni</th></tr></thead>
                <tbody>
                <?php
                $list = $conn->query("SELECT E.eveniment_id, E.tip_eveniment, E.numar_persoane, E.status, E.data_eveniment, S.denumire as sala, M.denumire as meniu 
                                      FROM Eveniment E JOIN Sala S ON E.sala_id=S.sala_id JOIN Meniu M ON E.meniu_id=M.meniu_id 
                                      WHERE E.client_id=$client_id ORDER BY E.data_eveniment DESC");
                if ($list->num_rows > 0) {
                    while($row = $list->fetch_assoc()) {
                        echo "<tr>
                            <td><strong style='color:white'>".$row['tip_eveniment']."</strong><br><span style='font-size:10px'>".$row['data_eveniment']."</span></td>
                            <td>".$row['sala']."</td>
                            <td>".$row['meniu']."</td>
                            <td><span style='padding:5px 10px; background:rgba(255,255,255,0.1); border-radius:5px; font-size:12px;'>".$row['status']."</span></td>
                            <td><form method='POST' style='display:flex; gap:5px;'><input type='hidden' name='id_eveniment_update' value='".$row['eveniment_id']."'><input type='number' name='nr_persoane_nou' value='".$row['numar_persoane']."' style='width:60px; padding:5px;'><button type='submit' name='actualizeaza_nr' class='btn-action save'>Save</button></form></td>
                            <td style='text-align:right'><form method='POST' onsubmit=\"return confirm('Sigur anulezi?');\"><input type='hidden' name='id_eveniment' value='".$row['eveniment_id']."'><button type='submit' name='sterge_rezervare' class='btn-action delete'>Anulează</button></form></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; padding:30px; color:#666;'>Nu există rezervări.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
