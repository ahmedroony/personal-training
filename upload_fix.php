<?php
$ftp_server = "ftp-sadsadawss.alwaysdata.net";
$ftp_user = "sadsadawss";
$ftp_pass = "Ab01063640700@";

$conn = ftp_ssl_connect($ftp_server);
if (!$conn) {
    die("Couldn't connect to $ftp_server");
}

if (@ftp_login($conn, $ftp_user, $ftp_pass)) {
    echo "FTP Connected!\n";
    
    $local_file = "fix_remote.php";
    
    file_put_contents($local_file, '<?php
        $output = [];
        chdir(__DIR__ . "/..");
        exec("cp .env.example .env", $output);
        exec("sed -i \'s/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/g\' .env", $output);
        exec("sed -i \'s/# DB_HOST=127.0.0.1/DB_HOST=mysql-sadsadawss.alwaysdata.net/g\' .env", $output);
        exec("sed -i \'s/# DB_DATABASE=laravel/DB_DATABASE=sadsadawss_personaltraining/g\' .env", $output);
        exec("sed -i \'s/# DB_USERNAME=root/DB_USERNAME=sadsadawss/g\' .env", $output);
        exec("sed -i \'s/# DB_PASSWORD=/DB_PASSWORD=12345678/g\' .env", $output);
        
        exec("php artisan key:generate 2>&1", $output);
        exec("php artisan optimize:clear 2>&1", $output);
        exec("php artisan migrate:fresh --force 2>&1", $output);
        
        echo "<pre>";
        print_r($output);
        echo "</pre>";
        echo "Done successfully!";
    ?>');
    
    $remote_file = "personal-training/public/fix.php"; 
    
    if (ftp_put($conn, $remote_file, $local_file, FTP_ASCII)) {
        echo "Successfully uploaded $remote_file\n";
    } else {
        echo "There was a problem while uploading $remote_file\n";
    }
} else {
    echo "FTP Login failed\n";
}
ftp_close($conn);
