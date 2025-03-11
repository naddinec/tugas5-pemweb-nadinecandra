<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

$cv_data = $_SESSION['cv_data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="cv-container">
        <h2>Curriculum Vitae</h2>
        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
        <p><strong>Nama:</strong> <?php echo $cv_data['nama']; ?></p>
        <p><strong>Tempat, Tanggal Lahir:</strong> <?php echo $cv_data['ttl']; ?></p>

        <h3>Ringkasan Profesional</h3>
        <p><?php echo $cv_data['profile']; ?></p>

        <h3>Riwayat Pekerjaan</h3>
        <?php
        for ($i = 0; $i < count($cv_data['work_exp']); $i++) {
            echo "<div class='work-exp'>";
            echo "<h4>{$cv_data['work_exp'][$i]}</h4>";
            echo "<p>{$cv_data['work_exp_desc'][$i]}</p>";
            echo "</div>";
        }
        ?>

        <h3>Riwayat Pendidikan</h3>
        <div class="education">
            <p><?php echo $cv_data['education']; ?></p>
        </div>

        <h3>Skills</h3>
        <ul>
            <?php foreach ($cv_data['skills'] as $skill) echo "<li>$skill</li>"; ?>
        </ul>
        <?php if (isset($cv_data['foto'])) echo "<img class='profile-img' src='{$cv_data['foto']}' alt='Foto Profile'>"; ?>
    </div>
</body>
</html>