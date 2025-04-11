<?php
function redirect($url) {
    header("Location: " . $url);
    exit();
}

function alert($message, $type = 'info') {
    $safe_message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');    
    echo "<script type='text/javascript'>alert('$safe_message');</script>";
}

function alertAndRedirect($message, $url, $type = 'info') {
    $safe_message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    
    echo "<script type='text/javascript'>
            alert('$safe_message');
            setTimeout(function() { window.location.href = '$url'; });
          </script>";
          exit();
}
?>