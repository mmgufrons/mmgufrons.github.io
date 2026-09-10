#!/bin/bash

cd /Applications/XAMPP/xamppfiles/htdocs/smsrm/mkt/tools/banner

# 1. Create PHP header
cat << 'EOF' > index.php
<?php
session_start();
if (!isset($_SESSION['login_simasrim']) || $_SESSION['login_simasrim'] !== true) {
    header("Location: ../../login.php");
    exit;
}
?>
EOF

# 2. Append the original HTML content
cat index.html >> index.php

# 3. Insert Back to MKT Hub button right after <body>
sed -i '' 's|<body>|<body>\
<div style="position: absolute; top: 20px; left: 20px;">\
    <a href="../../index.php" style="text-decoration: none; display: flex; align-items: center; gap: 8px; color: #7335B7; font-weight: 600; background: #f3effa; padding: 10px 16px; border-radius: 8px; border: 1px solid #d8cde9;">\
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>\
        Back to MKT Hub\
    </a>\
</div>|g' index.php

# 4. Remove original html file
rm index.html

echo "Migration for banner successful."
