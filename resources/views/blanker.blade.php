<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect</title>
    <script>
        window.onload = function() {
            window.open('{{ $url }}', '_blank'); // Open in new tab
            window.location.href = '{{ $url }}'; // Redirect in the same tab (optional)
        };
    </script>
</head>
<body>
    <p>Redirecting...</p>
</body>
</html>
