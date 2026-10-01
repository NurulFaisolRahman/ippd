import os, glob

for filepath in glob.glob('application/views/Provinsi/*.php'):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    if 'BaseURL+"Nasional/' in content:
        content = content.replace('BaseURL+"Nasional/', 'BaseURL+"Provinsi/')
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f'Fixed {filepath}')
