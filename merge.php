<?php

$panel = file_get_contents('resources/views/pos/panel.blade.php');
$idx = file_get_contents('resources/views/pos/index.blade.php');

preg_match('/<script>\s*function app\(\).*?<\/script>/s', $idx, $script_match);
$alpine = isset($script_match[0]) ? $script_match[0] : '';

preg_match('/(<!-- ===== CLIENTES ===== -->.*?)(?=<!-- ===== INVENTARIO ===== -->)/s', $idx, $c_match);
preg_match('/(<!-- ===== INVENTARIO ===== -->.*?)(?=<!-- ===== PUNTO DE VENTA \(POS\) ===== -->)/s', $idx, $i_match);
preg_match('/(<!-- ===== PUNTO DE VENTA \(POS\) ===== -->.*?)(?=<!-- ===== CAJA ===== -->)/s', $idx, $p_match);

$clientes = isset($c_match[1]) ? $c_match[1] : '';
$inventario = isset($i_match[1]) ? $i_match[1] : '';
$pos = isset($p_match[1]) ? $p_match[1] : '';

preg_match('/(<!-- Modal: Cliente -->.*?)<script>/s', $idx, $m_match);
$modals = isset($m_match[1]) ? $m_match[1] : '';

$panel = str_replace('</head>', '    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>' . PHP_EOL . '</head>', $panel);
$panel = str_replace('<body>', '<body x-data="app()" x-init="init()">', $panel);

// Navigation replacing
$panel = preg_replace('/<a href="\{\{ route\(\'panel\'\) \}\}" class="nav-item[ \w]*">/', '<button @click="page=\'panel\'" class="nav-item" :class="page===\'panel\'?\'active\':\'\'">', $panel);
$panel = str_replace('Panel
            </a>', 'Panel
            </button>', $panel);

$panel = preg_replace('/<a href="\{\{ route\(\'inventario\.index\'\) \}\}" class="nav-item[ \w]*">/', '<button @click="page=\'inventario\'" class="nav-item" :class="page===\'inventario\'?\'active\':\'\'">', $panel);
$panel = str_replace('Inventario
                @if', 'Inventario
            </button>
                <!-- @if', $panel);
$panel = str_replace('</span>@endif
            </a>', '</span>@endif -->', $panel);

$panel = preg_replace('/<a href="\{\{ url\(\'\/\?pos=true\'\) \}\}" class="nav-item[ \w]*">/', '<button @click="page=\'pos\'" class="nav-item" :class="page===\'pos\'?\'active\':\'\'">', $panel);
$panel = str_replace('Punto de Venta
            </a>', 'Punto de Venta
            </button>', $panel);

$panel = str_replace('Panel
            </button>', 'Panel
            </button>
            <button @click="page=\'clientes\'" class="nav-item" :class="page===\'clientes\'?\'active\':\'\'">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Directorio
            </button>', $panel);

$panel = preg_replace('/<a href="\{\{ url\(\'\/\?pos=true\'\) \}\}" class="(btn-venta|btn-tpv|sb-action)">/', '<button @click="page=\'pos\'" class="$1">', $panel);
$panel = str_replace('Nueva venta
            </a>', 'Nueva venta
            </button>', $panel);
$panel = str_replace('Nueva Venta
            </a>', 'Nueva Venta
            </button>', $panel);

$panel = preg_replace('/<div class="topbar-title">.*?<\/div>/', '<div class="topbar-title" x-text="{\'panel\':\'Panel de Control\',\'clientes\':\'Directorio de Clientes\',\'inventario\':\'Inventario\',\'pos\':\'Terminal TPV\',\'caja\':\'Caja\'}[page]||page"></div>', $panel);

$panel = preg_replace('/(<!-- KPI GRID -->)/', '<div x-show="page===\'panel\'">' . PHP_EOL . '$1', $panel);
$panel = preg_replace('/(<\/div><!-- \/bottom-grid -->)/', '$1' . PHP_EOL . '</div><!-- /x-show panel -->', $panel);

$panel = str_replace('</div><!-- /x-show panel -->', '</div><!-- /x-show panel -->' . PHP_EOL . PHP_EOL . $clientes . PHP_EOL . $inventario . PHP_EOL . $pos . PHP_EOL, $panel);

$panel = str_replace('</div><!-- /app -->', '</div><!-- /app -->' . PHP_EOL . PHP_EOL . $modals, $panel);
$panel = str_replace('</body>', $alpine . PHP_EOL . '</body>', $panel);

file_put_contents('resources/views/pos/panel.blade.php', $panel);
echo "PHP merge done.";
