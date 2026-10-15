import re

def process_file():
    with open('application/controllers/Provinsi.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # The authorization check code
    auth_check = """
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }"""

    # We want to match exactly the start of the Input, Edit, Hapus functions
    # and insert the auth_check right after the opening brace.
    def replacer(match):
        func_def = match.group(0)
        return func_def + auth_check

    content = re.sub(r'(public\s+function\s+(?:Input|Edit|Hapus)[A-Za-z0-9_]*\s*\(\)\s*\{)', replacer, content)

    with open('application/controllers/Provinsi.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
