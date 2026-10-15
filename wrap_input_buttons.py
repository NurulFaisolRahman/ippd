import os
import glob
import re

def process_views():
    directory = 'application/views/Provinsi'
    files = glob.glob(os.path.join(directory, '*.php'))
    
    for filepath in files:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
            
        modified = False
        
        # Regex to match the button-icon-btn div that contains a button targeting a modal
        # We make sure it's not already wrapped by checking the preceding characters.
        # Actually, it's safer to just find it and replace it. If it's already wrapped, we might double-wrap it.
        # Let's check if "<?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [1, 2])) { ?>" is right before it.
        
        pattern = r'(<div class="button-icon-btn[^>]*>.*?data-target="#ModalInput.*?</div>)'
        
        matches = re.finditer(pattern, content, flags=re.DOTALL)
        for match in matches:
            full_match = match.group(1)
            
            # Check if it's already wrapped
            idx = content.find(full_match)
            if idx > 0:
                preceding = content[max(0, idx-100):idx]
                if "in_array($_SESSION['Level'], [1, 2])" in preceding:
                    continue # already wrapped
            
            wrapped = "<?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [1, 2])) { ?>\n" + full_match + "\n<?php } ?>"
            content = content.replace(full_match, wrapped)
            modified = True

        if modified:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"Wrapped input button in {os.path.basename(filepath)}")

process_views()
