import os
import glob

def process_views():
    directory = 'application/views/Provinsi'
    files = glob.glob(os.path.join(directory, '*.php'))
    
    for filepath in files:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
            
        modified = False
        
        # We might have different variations of spacing.
        # "isset($_SESSION['Level']) && $_SESSION['Level'] == 2"
        # "(isset($_SESSION['Level']) && $_SESSION['Level'] == 2)"
        # Let's just do a simple string replace.
        old_str1 = "isset($_SESSION['Level']) && $_SESSION['Level'] == 2"
        new_str1 = "isset($_SESSION['Level']) && in_array($_SESSION['Level'], [1, 2])"
        
        if old_str1 in content:
            content = content.replace(old_str1, new_str1)
            modified = True
            
        old_str2 = "isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 2"
        new_str2 = "isset($_SESSION['Level']) && in_array((int)$_SESSION['Level'], [1, 2])"
        
        if old_str2 in content:
            content = content.replace(old_str2, new_str2)
            modified = True

        if modified:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"Modified {os.path.basename(filepath)}")

process_views()
