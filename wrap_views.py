import os
import glob

def process_views():
    directory = 'application/views/Provinsi'
    files = glob.glob(os.path.join(directory, '*.php'))
    
    for filepath in files:
        if 'header.php' in filepath:
            continue
            
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
            
        modified = False
        
        # Add main-content wrapper
        if '<div class="main-content">' not in content:
            if '<div class="data-table-area">' in content:
                content = content.replace('<div class="data-table-area">', '<div class="main-content">\n<div class="data-table-area">')
                modified = True
        
        # Change container to container-fluid
        if '<div class="container">' in content:
            content = content.replace('<div class="container">', '<div class="container-fluid">')
            modified = True
            
        # Append closing div if we added main-content
        if modified and '<div class="main-content">' in content and '<!-- /.main-content -->' not in content:
            content += '\n</div><!-- /.main-content -->'
            
        if modified:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"Modified {os.path.basename(filepath)}")

process_views()
