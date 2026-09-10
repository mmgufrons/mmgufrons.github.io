import re

with open('/Applications/XAMPP/xamppfiles/htdocs/smsrm/mkt/tools/banner/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

php_header = """<?php
session_start();
if (!isset($_SESSION['login_simasrim']) || $_SESSION['login_simasrim'] !== true) {
    header("Location: ../../login.php");
    exit;
}
?>
"""
content = php_header + content

# Add back button after body tag
back_btn = """<div style="position: absolute; top: 20px; left: 20px;">
    <a href="../../index.php" style="text-decoration: none; display: flex; align-items: center; gap: 8px; color: #7335B7; font-weight: 600; background: #f3effa; padding: 10px 16px; border-radius: 8px; border: 1px solid #d8cde9;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Back to MKT Hub
    </a>
</div>\n"""
content = content.replace('<body>', '<body>\n' + back_btn)

with open('/Applications/XAMPP/xamppfiles/htdocs/smsrm/mkt/tools/banner/index.php', 'w', encoding='utf-8') as f:
    f.write(content)
print("Conversion successful")
