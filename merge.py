import re

with open(r'c:\Users\estre\Downloads\SISTEMA DE VENTA\laravel-app\resources\views\pos\panel.blade.php', 'r', encoding='utf-8') as f:
    panel = f.read()

with open(r'c:\Users\estre\Downloads\SISTEMA DE VENTA\laravel-app\resources\views\pos\index.blade.php', 'r', encoding='utf-8') as f:
    idx = f.read()

# 1. Extract the Alpine.js app() script and <script defer src=...> from index.blade.php
script_match = re.search(r'<script>\s*function app\(\).*?</script>', idx, re.DOTALL)
alpine_script = script_match.group(0) if script_match else ''

# Get all the hidden panels from index.blade.php
clientes_html_match = re.search(r'(<!-- ===== CLIENTES ===== -->.*?)(?=<!-- ===== INVENTARIO ===== -->)', idx, re.DOTALL)
inventario_html_match = re.search(r'(<!-- ===== INVENTARIO ===== -->.*?)(?=<!-- ===== PUNTO DE VENTA \(POS\) ===== -->)', idx, re.DOTALL)
pos_html_match = re.search(r'(<!-- ===== PUNTO DE VENTA \(POS\) ===== -->.*?)(?=<!-- ===== CAJA ===== -->)', idx, re.DOTALL)

clientes_html = clientes_html_match.group(1) if clientes_html_match else ''
inventario_html = inventario_html_match.group(1) if inventario_html_match else ''
pos_html = pos_html_match.group(1) if pos_html_match else ''

# Also grab modals and toast from index
modals_toast_match = re.search(r'(<!-- Modal: Cliente -->.*?)<script>', idx, re.DOTALL)
modals_toast_html = modals_toast_match.group(1) if modals_toast_match else ''

# 2. Modify panel.blade.php
# Add AlpineJS CDN and alpine init to body
panel = panel.replace('</head>', '    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>\n</head>')
panel = panel.replace('<body>', '<body x-data="app()" x-init="init()">')

# Make sidebar nav functional
panel = re.sub(r'<a href="\{\{ route\(\'panel\'\) \}\}" class="nav-item[ \w]*">', r'<button @click="page=\'panel\'" class="nav-item" :class="page===\'panel\'?\'active\':\'\'">', panel)
panel = panel.replace('Panel\n            </a>', 'Panel\n            </button>')

panel = re.sub(r'<a href="\{\{ route\(\'inventario\.index\'\) \}\}" class="nav-item[ \w]*">', r'<button @click="page=\'inventario\'" class="nav-item" :class="page===\'inventario\'?\'active\':\'\'">', panel)
panel = panel.replace('Inventario\n                @if', 'Inventario\n            </button>\n                <!-- @if') # simple fix
panel = panel.replace('</span>@endif\n            </a>', '</span>@endif -->')

panel = re.sub(r'<a href="\{\{ url\(\'/\?pos=true\'\) \}\}" class="nav-item[ \w]*">', r'<button @click="page=\'pos\'" class="nav-item" :class="page===\'pos\'?\'active\':\'\'">', panel)
panel = panel.replace('Punto de Venta\n            </a>', 'Punto de Venta\n            </button>')

# Add Directorio back to Sidebar
panel = panel.replace('Panel\n            </button>', 'Panel\n            </button>\n            <button @click="page=\'clientes\'" class="nav-item" :class="page===\'clientes\'?\'active\':\'\'">\n                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>\n                Directorio\n            </button>')

# Fix "Nueva Venta" button in topbar and sidebar
panel = re.sub(r'<a href="\{\{ url\(\'/\?pos=true\'\) \}\}" class="(btn-venta|btn-tpv|sb-action)">', r'<button @click="page=\'pos\'" class="\1">', panel)
panel = panel.replace('Nueva venta\n            </a>', 'Nueva venta\n            </button>')
panel = panel.replace('Nueva Venta\n            </a>', 'Nueva Venta\n            </button>')

# Transform topbar title
panel = re.sub(r'<div class="topbar-title">.*?</div>', r'<div class="topbar-title" x-text="{\'panel\':\'Panel de Control\',\'clientes\':\'Directorio de Clientes\',\'inventario\':\'Inventario\',\'pos\':\'Terminal TPV\',\'caja\':\'Caja\'}[page]||page"></div>', panel)

# Wrap existing panel content in x-show="page==='panel'"
panel = re.sub(r'(<!-- KPI GRID -->)', r'<div x-show="page===\'panel\'">\n\1', panel)
panel = re.sub(r'(</div><!-- /bottom-grid -->)', r'\1\n</div><!-- /x-show panel -->', panel)

# Inject other pages into Content area
panel = panel.replace('</div><!-- /x-show panel -->', f'</div><!-- /x-show panel -->\n\n{clientes_html}\n{inventario_html}\n{pos_html}\n')

# Inject Modals after app div
panel = panel.replace('</div><!-- /app -->', f'</div><!-- /app -->\n\n{modals_toast_html}')

# Inject script at end
panel = panel.replace('</body>', f'{alpine_script}\n</body>')

with open(r'c:\Users\estre\Downloads\SISTEMA DE VENTA\laravel-app\resources\views\pos\panel.blade.php', 'w', encoding='utf-8') as f:
    f.write(panel)

print("Panel fully merged with AlpineJS from index!")
