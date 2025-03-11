<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES['foto']['name']);
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $_SESSION['cv_data']['foto'] = $target_file;
        } else {
            $error = "Maaf, terjadi kesalahan saat mengupload gambar.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['cv_data'] = $_POST;
    header('Location: cv.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CV</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2><b>Form CV</b></h2>
        <form method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="ttl">Tempat, Tanggal Lahir:</label>
            <input type="text" id="ttl" name="ttl" required>

            <label for="profile">Ringkasan Profesional:</label>
            <textarea id="profile" name="profile" required></textarea>

            <div id="work-experience">
                <label>Riwayat Pekerjaan:</label>
                <div class="work-exp">
                    <input type="text" name="work_exp[]" placeholder="Posisi" required>
                    <input type="text" name="work_exp_desc[]" placeholder="Deskripsi" required>
                </div>
            </div>
            <button type="button" onclick="addWorkExp()">Tambah Work Experience</button>

            <label for="education">Riwayat Pendidikan:</label>
            <textarea id="education" name="education" required></textarea>

            <div id="skills">
                <label>Skills:</label>
                <input type="text" name="skills[]" placeholder="Skill" required>
            </div>
            <button type="button" onclick="addSkill()">Tambah Skill</button>

            <label for="foto">Foto Profile:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        function addWorkExp() {
            const div = document.createElement('div');
            div.className = 'work-exp';
            div.innerHTML = `
                <input type="text" name="work_exp[]" placeholder="Posisi" required>
                <input type="text" name="work_exp_desc[]" placeholder="Deskripsi" required>
            `;
            document.getElementById('work-experience').appendChild(div);
        }

        function addSkill() {
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'skills[]';
            input.placeholder = 'Skill';
            input.required = true;
            document.getElementById('skills').appendChild(input);
        }
    </script>
</body>
</html>