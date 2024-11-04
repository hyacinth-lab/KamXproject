<?php
include 'db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $confirm = $_POST['confirm'] ?? null;
    $coins = isset($_POST['coins']) ? (int)$_POST['coins'] : 0;

    if (empty($email) || empty($password)) {
        echo "<script>alert('Email and Password are required.'); window.location.href='index.html';</script>";
        exit;
    }

    // Check if the user exists in the database
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User exists, prompt to log in
            if (password_verify($password, $user['password'])) {
                // Successful login
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['coins'] = $user['coins'];
                
                echo "<script>
                        alert('Login successful. Welcome back, {$user['name']}!');
                        window.location.href = 'index.php';
                      </script>";
            } else {
                // Incorrect password
                echo "<script>alert('Incorrect password. Please try again.'); window.location.href='index.html';</script>";
            }
        } else {
            // User does not exist, proceed with registration
            if ($password !== $confirm) {
                echo "<script>alert('Passwords do not match.'); window.location.href='index.html';</script>";
                exit;
            }

            // Hash password and generate a referral code
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $referral_code = substr(md5(uniqid(rand(), true)), 0, 8); // Generate unique referral code

            $stmt = $conn->prepare("INSERT INTO users (name, email, password, coins, referral_code) VALUES (:name, :email, :password, :coins, :referral_code)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':coins', $coins);
            $stmt->bindParam(':referral_code', $referral_code);
            $stmt->execute();

            echo "<script>
                    alert('Registration successful. Please log in.');
                    window.location.href = 'index.html';
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>