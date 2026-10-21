
<?php
$nama = "";
$email = "";
$nilai = "";
$status = "";
$error = "";

if (isset($_POST['proses'])) {
    $nama  = trim($_POST['nama'] ?? "");
    $email = trim($_POST['email'] ?? "");
    $nilai = trim($_POST['nilai'] ?? "");

    if ($nama === "" || $email === "" || $nilai === "") {
        $error = "Semua kolom wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid.";
    } elseif (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
        $error = "Nilai ujian harus berupa angka 0 - 100.";
    } else {
        $status = ($nilai > 70) ? "Lulus" : "Remedial";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nilai Ujian</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 16px;
        }

        .container {
            width: 100%;
            max-width: 460px;
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
            color: #0f172a;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            border: 1px solid #e2e8f0;
        }

        .card h2 {
            margin-top: 0;
            font-size: 20px;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s;
        }

        input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
        }

        button {
            width: 100%;
            padding: 13px;
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 9px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 4px;
        }

        button:hover {
            background: #4338ca;
        }

        .result {
            margin-top: 22px;
            padding: 20px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .result h2 {
            margin: 0 0 16px;
            font-size: 19px;
        }

        .result p {
            margin: 10px 0;
            overflow-wrap: anywhere;
            line-height: 1.5;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .lulus {
            color: #166534;
            background: #dcfce7;
        }

        .remedial {
            color: #9a3412;
            background: #ffedd5;
        }

        .error {
            margin-top: 20px;
            padding: 12px;
            background: #fee2e2;
            color: #b91c1c;
            border-radius: 9px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <main class="container">
        <header class="header">
            <h1>Form Nilai Ujian</h1>
            <p>Masukkan data untuk memeriksa hasil ujian.</p>
        </header>

        <section class="card">
            <h2>Data Peserta</h2>

            <form method="POST">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        placeholder="Masukkan nama"
                        value="<?= htmlspecialchars($nama) ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="nama@email.com"
                        value="<?= htmlspecialchars($email) ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="nilai">Nilai Ujian (0–100)</label>
                    <input
                        type="number"
                        id="nilai"
                        name="nilai"
                        min="0"
                        max="100"
                        placeholder="Masukkan nilai"
                        value="<?= htmlspecialchars($nilai) ?>"
                        required
                    >
                </div>

                <button type="submit" name="proses" value="1">
                    Periksa Hasil
                </button>
            </form>

            <?php if ($error !== "") { ?>
                <div class="error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php } elseif ($status !== "") { ?>
                <div class="result">
                    <h2>Hasil Ujian</h2>

                    <p>
                        <strong>Nama:</strong>
                        <?= htmlspecialchars($nama) ?>
                    </p>

                    <p>
                        <strong>Email:</strong>
                        <?= htmlspecialchars($email) ?>
                    </p>

                    <p>
                        <strong>Nilai:</strong>
                        <?= htmlspecialchars($nilai) ?>
                    </p>

                    <p>
                        <strong>Status:</strong>
                        <span class="badge <?= $status === 'Lulus' ? 'lulus' : 'remedial' ?>">
                            <?= htmlspecialchars($status) ?>
                        </span>
                    </p>
                </div>
            <?php } ?>
        </section>

        <footer class="footer">
            Stupen PHP · Form Processing
        </footer>
    </main>
</body>
</html>
