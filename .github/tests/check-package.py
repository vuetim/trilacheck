"""Validate WordPress ZIP structure and prevent credential packaging."""
import sys
import zipfile
from pathlib import PurePosixPath

with zipfile.ZipFile(sys.argv[1]) as package:
    names = package.namelist()
    required = {'trilacheck/style.css', 'trilacheck/index.php', 'trilacheck/includes/internal-links.php'}
    assert required.issubset(names), 'Missing WordPress theme files'
    assert package.testzip() is None, 'Corrupt ZIP entry'
    for name in names:
        path = PurePosixPath(name)
        assert name.startswith('trilacheck/') and '\\' not in name and '..' not in path.parts, name
        assert not any(part in {'.git', '.github', '.deploy', '.env'} for part in path.parts), name
        if not name.endswith('/'):
            data = package.read(name)
            assert b'PRIVATE KEY-----' not in data, f'Credential material in {name}'
    assert b'Theme Name: Trilacheck' in package.read('trilacheck/style.css')
print(f'PASS: {len(names)} ZIP entries; valid theme folder, stylesheet and credential exclusions.')
