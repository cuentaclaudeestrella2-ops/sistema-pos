<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCars Cabrera – POS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body x-data="app()" x-init="init()" class="antialiased selection:bg-primary/30 selection:text-white">

<div class="flex h-screen overflow-hidden">

  <!-- Sidebar -->
  <aside class="w-64 bg-panel flex flex-col flex-shrink-0 border-r border-border-light">
    <div class="p-6 border-b border-border-light">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-primary/20 border border-primary/30 rounded-xl flex items-center justify-center">
          <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <div>
          <h1 class="font-display font-bold text-base leading-none" style="color:rgba(255,255,255,0.6);">AUTOCARS</h1>
          <h1 class="font-display font-bold text-base leading-none mt-0.5" style="color:rgba(255,42,77,0.7);">CABRERA</h1>
        </div>
      </div>
    </div>

    <nav class="flex-1 p-4 space-y-1">
      <p class="text-[10px] font-bold text-muted uppercase tracking-widest px-3 mb-3 mt-1">Módulos</p>

      <div class="nav-item group" :class="page==='panel'?'active':''" @click="page='panel'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        <span>Panel Principal</span>
      </div>
      <div class="nav-item group" :class="page==='clientes'?'active':''" @click="page='clientes'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        <span>Directorio</span>
      </div>
      <div class="nav-item group" :class="page==='inventario'?'active':''" @click="page='inventario'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        <span>Inventario</span>
      </div>
      <div class="nav-item group" :class="page==='pos'?'active':''" @click="page='pos'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        <span>Punto de Venta</span>
      </div>
      <div class="nav-item group" :class="page==='caja'?'active':''" @click="page='caja'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>Caja y Cierre</span>
      </div>
    </nav>

    <div class="p-4 border-t border-border-light">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-primary to-accent flex items-center justify-center text-white font-bold text-sm">EC</div>
        <div>
          <p class="text-xs text-muted">Administrador</p>
          <p class="text-sm font-bold text-white">Estrella Cabrera L.</p>
        </div>
      </div>
    </div>
  </aside>

  <!-- Main -->
  <div class="flex-1 flex flex-col overflow-hidden">

    <!-- Topbar -->
    <header class="px-8 py-4 flex items-center justify-between flex-shrink-0 border-b border-border-light bg-black/40 backdrop-blur-xl">
      <h2 class="title text-2xl font-bold text-white flex items-center gap-3">
        <span x-text="{'panel':'Resumen General','clientes':'Directorio','inventario':'Inventario','pos':'Punto de Venta','caja':'Caja y Cierre'}[page]||'Panel'"></span>
        <div class="h-2 w-2 rounded-full bg-success animate-pulse-slow"></div>
      </h2>
      <div class="flex items-center gap-4">
        <button class="btn-primary px-5 py-2 flex items-center gap-2 font-bold title text-sm" @click="page='pos'">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
          NUEVA VENTA (TPV)
        </button>
        <div class="bg-surface border border-border-light px-3 py-2 flex items-center gap-2 rounded-lg text-sm text-white/80">
          <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span x-text="new Date().toLocaleDateString('es-PE',{day:'2-digit',month:'long',year:'numeric'})"></span>
        </div>
      </div>
    </header>

    <!-- Content -->
    <main class="flex-1 overflow-y-auto p-8">

      <!-- ===== PANEL ===== -->
      <div x-show="page==='panel'" class="space-y-6" style="display:none;">
        <div class="grid grid-cols-4 gap-5">
          <div class="kpi border-t-2" style="border-top-color:#FFB800;">
            <p class="text-muted text-xs font-bold uppercase tracking-wider mb-2">Ventas de Hoy</p>
            <p class="kpi-val text-white" x-text="'S/ '+totalVentasHoy().toFixed(2)"></p>
            <span class="badge badge-warn mt-4 text-[10px]" x-text="movimientos.filter(m=>m.tipo==='ingreso').length+' transacciones'"></span>
          </div>
          <div class="kpi border-t-2" style="border-top-color:#00E676;">
            <p class="text-muted text-xs font-bold uppercase tracking-wider mb-2">Saldo en Caja</p>
            <p class="kpi-val text-success" x-text="'S/ '+saldoCaja().toFixed(2)"></p>
            <span class="text-xs text-success/70 mt-4 block">Disponible</span>
          </div>
          <div class="kpi border-t-2" style="border-top-color:#FF2A4D;">
            <p class="text-muted text-xs font-bold uppercase tracking-wider mb-2">Alertas Stock</p>
            <p class="kpi-val text-primary" x-text="inventario.filter(i=>i.stock<=i.stockMin).length"></p>
            <span class="badge badge-low mt-4 text-[10px]">Requieren reposición</span>
          </div>
          <div class="kpi border-t-2 border-border-light">
            <p class="text-muted text-xs font-bold uppercase tracking-wider mb-2">Clientela Activa</p>
            <p class="kpi-val text-white" x-text="clientes.length"></p>
            <span class="badge badge-ok mt-4 text-[10px]">Cartera de clientes</span>
          </div>
        </div>

        <div class="grid grid-cols-3 gap-6">
          <div class="col-span-2 bg-card p-6 border border-border-light shadow-2xl">
            <h3 class="title font-bold text-lg text-white mb-4 flex items-center gap-2">
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
              Últimos Movimientos
            </h3>
            <div class="overflow-x-auto">
              <table>
                <thead><tr><th>Hora</th><th>Concepto</th><th>Ref</th><th class="text-right">Monto</th></tr></thead>
                <tbody>
                  <template x-for="m in movimientos.slice().reverse().slice(0,6)">
                    <tr>
                      <td class="text-muted text-sm" x-text="m.fecha ? m.fecha.split(' ')[1]||'--':'--'"></td>
                      <td class="font-bold text-white" x-text="m.concepto"></td>
                      <td class="text-muted text-sm font-mono" x-text="m.referencia||'--'"></td>
                      <td class="font-bold text-right" :class="m.tipo==='ingreso'?'text-success':'text-primary'" x-text="(m.tipo==='ingreso'?'+':'-')+'S/ '+parseFloat(m.monto).toFixed(2)"></td>
                    </tr>
                  </template>
                </tbody>
              </table>
              <div x-show="movimientos.length===0" class="text-center py-8 text-muted">No hay transacciones aún.</div>
            </div>
          </div>

          <div class="bg-card p-6 border border-primary/20 shadow-2xl">
            <h3 class="title font-bold text-lg text-white mb-4 flex items-center gap-2">
              <svg class="w-5 h-5 text-primary animate-pulse-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
              Reposición Urgente
            </h3>
            <div x-show="inventario.filter(i=>i.stock<=i.stockMin).length===0" class="text-center py-6 text-muted">
              <span class="text-success text-2xl">✓</span>
              <p class="mt-2">Stock saludable</p>
            </div>
            <div class="space-y-2">
              <template x-for="p in inventario.filter(i=>i.stock<=i.stockMin).slice(0,5)">
                <div class="bg-base p-3 rounded-lg border border-border-light flex justify-between items-center" @click="page='inventario'">
                  <p class="text-sm font-bold text-white truncate" x-text="p.nombre"></p>
                  <span class="badge badge-low text-[10px] ml-2" x-text="p.stock+' ud'"></span>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>

      <!-- ===== CLIENTES ===== -->
      <div x-show="page==='clientes'" class="space-y-5" style="display:none;">
        <div class="flex items-center justify-between bg-card p-4 border border-border-light">
          <div class="relative w-80">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input x-model="busqCliente" placeholder="Buscar por nombre, RUC..." class="pl-9">
          </div>
          <button class="btn-primary py-2 px-5" @click="modalCliente=true;editCliente=null;formC={razon:'',comercial:'',tipoDoc:'RUC',nroDoc:'',telefono:'',email:'',direccion:'',distrito:'',ciudad:'Lima',credDias:0,limCredito:0,listaPrecio:'1',estado:'activo',notas:''}">
            + Nuevo Cliente
          </button>
        </div>
        <div class="bg-card border border-border-light overflow-hidden shadow-2xl">
          <div x-show="clientesFiltrados().length===0" class="text-center py-12 text-muted">Ningún cliente encontrado.</div>
          <table x-show="clientesFiltrados().length>0">
            <thead><tr><th>Doc</th><th>Razón Social</th><th>Teléfono</th><th>Estado</th><th class="text-right">Acciones</th></tr></thead>
            <tbody>
              <template x-for="c in clientesFiltrados()" :key="c.id">
                <tr>
                  <td><span class="badge bg-white/5 border-white/10 text-muted text-[10px]" x-text="c.tipoDoc+' '+c.nroDoc"></span></td>
                  <td class="font-bold text-white" x-text="c.razon"></td>
                  <td class="text-muted" x-text="c.telefono||'--'"></td>
                  <td><span class="badge" :class="c.estado==='activo'?'badge-ok':'badge-low'" x-text="c.estado"></span></td>
                  <td class="text-right space-x-2">
                    <button @click="abrirEditCliente(c)" class="text-accent hover:text-white p-1.5 bg-accent/5 rounded hover:bg-accent/20 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                    <button @click="eliminarCliente(c.id)" class="text-primary hover:text-white p-1.5 bg-primary/5 rounded hover:bg-primary/20 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ===== INVENTARIO ===== -->
      <div x-show="page==='inventario'" class="space-y-5" style="display:none;">
        <div class="flex items-center justify-between bg-card p-4 border border-border-light">
          <div class="relative w-80">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input x-model="busqInv" placeholder="Buscar por código o nombre..." class="pl-9">
          </div>
          <button class="btn-primary py-2 px-5" @click="formI={codigo:'',nombre:'',categoria:'Lubricantes',marca:'',unidad:'Unidad',precio1:'',precio2:'',precio3:'',stock:0,stockMin:0,stockMax:0,ubicacion:'',estado:'activo'};editInv=null;modalInv=true">
            + Nuevo Producto
          </button>
        </div>
        <div class="bg-card border border-border-light overflow-hidden shadow-2xl">
          <table>
            <thead><tr><th>Código</th><th>Producto</th><th>Categoría</th><th>Precio</th><th>Stock</th><th class="text-right">Acciones</th></tr></thead>
            <tbody>
              <template x-for="p in invFiltrado()" :key="p.id">
                <tr>
                  <td><span class="badge bg-white/5 border-white/10 text-muted text-[10px]" x-text="p.codigo"></span></td>
                  <td class="font-bold text-white truncate max-w-xs" x-text="p.nombre"></td>
                  <td class="text-muted" x-text="p.categoria"></td>
                  <td class="font-display font-bold text-white" x-text="'S/ '+parseFloat(p.precio1).toFixed(2)"></td>
                  <td><span class="badge text-[10px]" :class="p.stock<=0?'badge-low':p.stock<=p.stockMin?'badge-warn':'badge-ok'" x-text="p.stock+' '+p.unidad"></span></td>
                  <td class="text-right space-x-2">
                    <button @click="abrirEditInv(p)" class="text-accent hover:text-white p-1.5 bg-accent/5 rounded hover:bg-accent/20 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                    <button @click="eliminarProd(p.id)" class="text-primary hover:text-white p-1.5 bg-primary/5 rounded hover:bg-primary/20 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
          <div x-show="invFiltrado().length===0" class="text-center py-12 text-muted">No se encontraron productos.</div>
        </div>
      </div>

      <!-- ===== PUNTO DE VENTA (POS) ===== -->
      <div x-show="page==='pos'" class="flex gap-5 overflow-hidden" style="display:none; height: calc(100vh - 140px);">
        <!-- Product Catalog -->
        <div class="flex-1 flex flex-col bg-surface/50 rounded-2xl border border-border-light overflow-hidden">
          <div class="p-4 border-b border-border-light">
            <div class="relative mb-3">
              <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
              <input x-model="posBusq" type="text" placeholder="Buscar producto por código o nombre..." class="w-full pl-10 py-3 text-base" @keydown.enter.prevent="agregarPorBusqueda()">
            </div>
            <div class="flex gap-2 overflow-x-auto pb-1" style="scrollbar-width:none;">
              <button class="badge px-4 py-1.5 text-[10px] font-bold uppercase tracking-widest whitespace-nowrap cursor-pointer transition-colors" :class="posCategoria===''?'bg-primary text-white border-primary/50':'bg-surface border-border-light text-muted hover:bg-white/10'" @click="posCategoria=''">Todos</button>
              <template x-for="cat in [...new Set(inventario.map(i=>i.categoria).filter(Boolean))]">
                <button class="badge px-4 py-1.5 text-[10px] font-bold uppercase tracking-widest whitespace-nowrap cursor-pointer transition-colors" @click="posCategoria=cat" :class="posCategoria===cat?'bg-white/20 text-white border-white/30':'bg-surface border-border-light text-muted hover:bg-white/10'" x-text="cat"></button>
              </template>
            </div>
          </div>
          <div class="flex-1 overflow-y-auto p-4">
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
              <template x-for="p in inventario.filter(i=>(!posCategoria||i.categoria===posCategoria)&&(i.nombre.toLowerCase().includes(posBusq.toLowerCase())||i.codigo.toLowerCase().includes(posBusq.toLowerCase())))">
                <div class="bg-card border border-border-light rounded-xl p-4 cursor-pointer hover:border-accent hover:shadow-[0_0_15px_rgba(255,184,0,0.2)] hover:-translate-y-0.5 transition-all flex flex-col relative" @click="agregarAlCarrito(p)">
                  <div class="absolute top-0 right-0 p-2"><span class="badge text-[10px]" :class="p.stock<=0?'badge-low':p.stock<=p.stockMin?'badge-warn':''" x-text="p.stock+' ud'"></span></div>
                  <div class="w-10 h-10 bg-base rounded-full border border-border-light flex items-center justify-center text-muted mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                  </div>
                  <p class="font-bold text-sm text-white mb-2 flex-1 line-clamp-2" x-text="p.nombre"></p>
                  <div class="flex items-end justify-between mt-2 pt-2 border-t border-white/10">
                    <p class="text-[10px] uppercase text-muted font-bold" x-text="p.codigo"></p>
                    <p class="font-display font-bold text-white text-lg" x-text="'S/ '+parseFloat(p.precio1).toFixed(2)"></p>
                  </div>
                </div>
              </template>
              <div x-show="inventario.filter(i=>(!posCategoria||i.categoria===posCategoria)&&(i.nombre.toLowerCase().includes(posBusq.toLowerCase())||i.codigo.toLowerCase().includes(posBusq.toLowerCase()))).length===0" class="col-span-full py-16 text-center text-muted">
                No se encontraron productos.
              </div>
            </div>
          </div>
        </div>

        <!-- Cart -->
        <div class="w-96 flex flex-col bg-surface/90 rounded-2xl border border-border-light overflow-hidden flex-shrink-0">
          <div class="p-4 border-b border-border-light bg-base/50">
            <label class="text-[10px] text-muted uppercase tracking-widest block mb-1 font-bold">Cliente</label>
            <select x-model="posClienteId" class="w-full text-sm">
              <option value="">Cliente Genérico (Boleta)</option>
              <template x-for="c in clientes">
                <option :value="c.id" x-text="c.razon+' ('+c.nroDoc+')'"></option>
              </template>
            </select>
          </div>

          <div class="flex-1 overflow-y-auto">
            <div class="px-4 py-3 bg-base/80 border-b border-border-light flex justify-between items-center sticky top-0 z-10">
              <span class="text-[10px] font-bold text-muted uppercase tracking-widest">Orden</span>
              <button @click="carrito=[]" x-show="carrito.length>0" class="text-[10px] font-bold uppercase text-primary hover:text-white transition-colors">Vaciar</button>
            </div>

            <div x-show="carrito.length===0" class="flex flex-col items-center justify-center p-8 h-48 text-muted text-center text-sm">
              <svg class="w-8 h-8 mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
              El carrito está vacío.<br>Seleccione un producto.
            </div>

            <div class="divide-y divide-white/5">
              <template x-for="(item, index) in carrito" :key="index">
                <div class="p-4 hover:bg-white/5 transition-colors">
                  <div class="flex justify-between mb-2">
                    <p class="text-sm font-bold text-white flex-1 pr-2" x-text="item.nombre"></p>
                    <button @click="carrito.splice(index,1)" class="text-muted hover:text-primary transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                  </div>
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1 bg-base rounded-lg border border-border-light p-1">
                      <button @click="if(item.cantidad>1) item.cantidad--" class="w-7 h-7 flex items-center justify-center text-white hover:bg-white/10 rounded transition-colors font-bold">-</button>
                      <input type="number" x-model.number="item.cantidad" class="w-10 text-center bg-transparent border-none p-0 text-sm font-bold" min="1">
                      <button @click="item.cantidad++" class="w-7 h-7 flex items-center justify-center text-white hover:bg-white/10 rounded transition-colors font-bold">+</button>
                    </div>
                    <p class="font-display font-bold text-lg text-white" x-text="'S/ '+(item.precio*item.cantidad).toFixed(2)"></p>
                  </div>
                </div>
              </template>
            </div>
          </div>

          <!-- Totals -->
          <div class="p-5 bg-card border-t border-border-light flex-shrink-0">
            <div class="space-y-2 mb-4">
              <div class="flex justify-between text-sm text-muted">
                <span>Subtotal</span>
                <span class="font-display text-white" x-text="'S/ '+(totalCarrito()/1.18).toFixed(2)"></span>
              </div>
              <div class="flex justify-between text-sm text-muted">
                <span>IGV (18%)</span>
                <span class="font-display text-white" x-text="'S/ '+(totalCarrito()-totalCarrito()/1.18).toFixed(2)"></span>
              </div>
              <div class="flex justify-between items-end pt-3 border-t border-white/10">
                <span class="text-[10px] font-bold uppercase text-muted">Total</span>
                <span class="text-2xl font-display font-bold text-success" x-text="'S/ '+totalCarrito().toFixed(2)"></span>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-3 mb-4">
              <div>
                <label class="text-[10px] text-muted uppercase tracking-widest block mb-1 font-bold">Comprobante</label>
                <select x-model="posTipoComprobante" class="w-full text-sm">
                  <option value="Boleta">Boleta</option>
                  <option value="Factura">Factura</option>
                  <option value="Ticket">Ticket</option>
                </select>
              </div>
              <div>
                <label class="text-[10px] text-muted uppercase tracking-widest block mb-1 font-bold">Medio de Pago</label>
                <select x-model="posMedioPago" class="w-full text-sm">
                  <option value="Efectivo">Efectivo 💵</option>
                  <option value="Yape/Plin">Yape/Plin 📱</option>
                  <option value="Tarjeta">Tarjeta 💳</option>
                  <option value="Transferencia">Transferencia 🏦</option>
                </select>
              </div>
            </div>
            <button class="w-full py-3.5 rounded-xl text-sm font-bold uppercase tracking-wide transition-all flex items-center justify-center gap-2"
              :disabled="carrito.length===0"
              :class="carrito.length===0?'bg-base border border-border-light text-muted cursor-not-allowed':'bg-primary hover:bg-primary/90 text-white shadow-[0_0_20px_rgba(255,42,77,0.4)] border border-primary/50'"
              @click="procesarVenta()">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
              COBRAR E IMPRIMIR
            </button>
          </div>
        </div>
      </div>

      <!-- ===== CAJA ===== -->
      <div x-show="page==='caja'" class="space-y-6" style="display:none;">
        <div class="grid grid-cols-3 gap-5">
          <div class="kpi border-t-2" style="border-top-color:#00E676;">
            <p class="text-muted text-xs font-bold uppercase tracking-wider mb-2">Ingresos Totales</p>
            <p class="text-3xl font-display font-bold text-success" x-text="'S/ '+movimientos.filter(m=>m.tipo==='ingreso').reduce((a,m)=>a+parseFloat(m.monto),0).toFixed(2)"></p>
          </div>
          <div class="kpi border-t-2" style="border-top-color:#FF2A4D;">
            <p class="text-muted text-xs font-bold uppercase tracking-wider mb-2">Egresos Totales</p>
            <p class="text-3xl font-display font-bold text-primary" x-text="'S/ '+movimientos.filter(m=>m.tipo==='egreso').reduce((a,m)=>a+parseFloat(m.monto),0).toFixed(2)"></p>
          </div>
          <div class="kpi border-t-2 border-border-light">
            <p class="text-muted text-xs font-bold uppercase tracking-wider mb-2">Saldo Neto</p>
            <p class="text-3xl font-display font-bold text-white" x-text="'S/ '+saldoCaja().toFixed(2)"></p>
          </div>
        </div>

        <div class="grid grid-cols-3 gap-6">
          <div class="bg-card p-6 border border-border-light shadow-2xl">
            <h3 class="title font-bold text-lg text-white mb-4">Registrar Operación</h3>
            <div class="space-y-3">
              <div>
                <label class="text-[10px] uppercase font-bold text-muted mb-1 block">Tipo</label>
                <select x-model="formM.tipo">
                  <option value="ingreso">Ingreso (+)</option>
                  <option value="egreso">Egreso (-)</option>
                </select>
              </div>
              <div>
                <label class="text-[10px] uppercase font-bold text-muted mb-1 block">Concepto</label>
                <input type="text" x-model="formM.concepto" placeholder="Ej: Pago Proveedor">
              </div>
              <div>
                <label class="text-[10px] uppercase font-bold text-muted mb-1 block">Monto (S/)</label>
                <input type="number" x-model="formM.monto" step="0.01" placeholder="0.00">
              </div>
              <button class="btn-primary w-full py-2.5 mt-2" @click="guardarMovimiento()">Registrar</button>
            </div>
          </div>

          <div class="col-span-2 bg-card p-6 border border-border-light shadow-2xl">
            <h3 class="title font-bold text-lg text-white mb-4">Historial de Caja</h3>
            <div class="space-y-2 max-h-80 overflow-y-auto pr-1">
              <template x-for="m in movimientos">
                <div class="flex justify-between items-center p-3 rounded-lg bg-white/5 border border-white/5">
                  <div>
                    <span class="badge text-[10px] mb-1" :class="m.tipo==='ingreso'?'badge-ok':'badge-low'" x-text="m.tipo"></span>
                    <p class="text-sm font-bold text-white" x-text="m.concepto"></p>
                    <p class="text-xs text-muted" x-text="m.fecha+(m.referencia?' | '+m.referencia:'')"></p>
                  </div>
                  <p class="font-display font-bold text-lg" :class="m.tipo==='ingreso'?'text-success':'text-primary'" x-text="(m.tipo==='ingreso'?'+':'-')+'S/ '+parseFloat(m.monto).toFixed(2)"></p>
                </div>
              </template>
              <div x-show="movimientos.length===0" class="text-center py-8 text-muted">Sin movimientos registrados.</div>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>

<!-- Modal: Cliente -->
<div x-show="modalCliente" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm" style="display:none;" @keydown.escape.window="modalCliente=false">
  <div class="bg-card rounded-2xl border border-border-light w-full max-w-2xl p-8 shadow-2xl relative">
    <h3 class="title font-bold text-xl text-white mb-6" x-text="editCliente?'Editar Cliente':'Nuevo Cliente'"></h3>
    <div class="grid grid-cols-2 gap-4 mb-6">
      <div class="col-span-2"><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Razón Social *</label><input x-model="formC.razon" placeholder="Nombre completo o empresa"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Tipo Doc</label><select x-model="formC.tipoDoc"><option>DNI</option><option>RUC</option><option>CE</option></select></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Nro. Documento *</label><input x-model="formC.nroDoc" placeholder="00000000"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Teléfono</label><input x-model="formC.telefono" placeholder="999 999 999"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Email</label><input x-model="formC.email" placeholder="correo@ejemplo.com"></div>
      <div class="col-span-2"><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Dirección</label><input x-model="formC.direccion" placeholder="Av. Principal 123"></div>
    </div>
    <div class="flex gap-3 justify-end">
      <button class="btn-ghost" @click="modalCliente=false">Cancelar</button>
      <button class="btn-primary" @click="guardarCliente()">Guardar Cliente</button>
    </div>
  </div>
</div>

<!-- Modal: Producto -->
<div x-show="modalInv" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm" style="display:none;" @keydown.escape.window="modalInv=false">
  <div class="bg-card rounded-2xl border border-border-light w-full max-w-2xl p-8 shadow-2xl">
    <h3 class="title font-bold text-xl text-white mb-6" x-text="editInv?'Editar Producto':'Nuevo Producto'"></h3>
    <div class="grid grid-cols-2 gap-4 mb-6">
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Código *</label><input x-model="formI.codigo" placeholder="AUT-001"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Nombre *</label><input x-model="formI.nombre" placeholder="Nombre del producto"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Categoría</label><input x-model="formI.categoria" list="cats" placeholder="Lubricantes"><datalist id="cats"><option>Motor</option><option>Lubricantes</option><option>Frenos</option><option>Eléctrico</option><option>Suspensión</option><option>Llantas</option><option>Herramientas</option></datalist></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Marca</label><input x-model="formI.marca" placeholder="Castrol, Bosch..."></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Precio Público (S/)</label><input type="number" x-model="formI.precio1" step="0.01" placeholder="0.00"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Precio Mayorista (S/)</label><input type="number" x-model="formI.precio2" step="0.01" placeholder="0.00"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Stock Actual</label><input type="number" x-model="formI.stock" placeholder="0"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Stock Mínimo (alerta)</label><input type="number" x-model="formI.stockMin" placeholder="5"></div>
    </div>
    <div class="flex gap-3 justify-end">
      <button class="btn-ghost" @click="modalInv=false">Cancelar</button>
      <button class="btn-primary" @click="guardarProducto()">Guardar Producto</button>
    </div>
  </div>
</div>

<!-- Toast -->
<div x-show="showToast" x-transition class="fixed bottom-6 right-6 z-[1000] py-3 px-5 rounded-xl bg-surface/90 backdrop-blur-xl border border-border-light flex items-center gap-3 shadow-2xl" style="display:none;">
  <div class="w-2.5 h-2.5 rounded-full" :class="toastTipo==='error'?'bg-primary':'bg-success'"></div>
  <span class="font-bold text-white text-sm" x-text="toastMsg"></span>
</div>

<script>
function app() {
  return {
    page: 'panel',
    csrfToken: '',
    inventario: [],
    clientes: [],
    carrito: [],
    movimientos: [],
    busqInv: '',
    busqCliente: '',
    posBusq: '',
    posCategoria: '',
    posMedioPago: 'Efectivo',
    posTipoComprobante: 'Boleta',
    posClienteId: '',
    modalCliente: false,
    modalInv: false,
    toastMsg: '',
    toastTipo: 'info',
    showToast: false,
    editCliente: null,
    editInv: null,
    formC: { razon:'', comercial:'', tipoDoc:'DNI', nroDoc:'', telefono:'', email:'', direccion:'', distrito:'', ciudad:'', credDias:0, limCredito:0, listaPrecio:'1', estado:'activo', notas:'' },
    formI: { codigo:'', nombre:'', categoria:'Lubricantes', marca:'', unidad:'Unidad', precio1:'', precio2:'', precio3:'', stock:0, stockMin:0, stockMax:0, ubicacion:'', estado:'activo' },
    formM: { tipo:'ingreso', metodo:'Efectivo', concepto:'', monto:'', referencia:'' },

    async init() {
      const meta = document.querySelector('meta[name="csrf-token"]');
      this.csrfToken = meta ? meta.getAttribute('content') : '';
      await this.refreshAll();
    },

    async refreshAll() {
      try {
        const [resC, resI, resM] = await Promise.all([
          fetch('/api/clientes'),
          fetch('/api/inventario'),
          fetch('/api/movimientos')
        ]);
        this.clientes = await resC.json();
        this.inventario = await resI.json();
        this.movimientos = await resM.json();
      } catch(e) {
        this.triggerToast('Error conectando con el servidor', 'error');
      }
    },

    async apiFetch(url, method='GET', data=null) {
      const opts = { method, headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': this.csrfToken, 'Accept':'application/json' } };
      if(data) opts.body = JSON.stringify(data);
      const res = await fetch(url, opts);
      if(!res.ok) throw new Error('API error');
      return await res.json();
    },

    triggerToast(m, t='info') {
      this.toastMsg = m; this.toastTipo = t; this.showToast = true;
      setTimeout(() => this.showToast=false, 3000);
    },

    totalCarrito() {
      return this.carrito.reduce((a, i) => a + (parseFloat(i.precio) * i.cantidad), 0);
    },

    totalVentasHoy() {
      return this.movimientos.filter(m=>m.tipo==='ingreso').reduce((a,m)=>a+parseFloat(m.monto),0);
    },

    saldoCaja() {
      return this.movimientos.reduce((a,m)=>m.tipo==='ingreso'?a+parseFloat(m.monto):a-parseFloat(m.monto),0);
    },

    clientesFiltrados() {
      const b = this.busqCliente.toLowerCase();
      return this.clientes.filter(c=>(c.razon+c.nroDoc+(c.email||'')).toLowerCase().includes(b));
    },

    invFiltrado() {
      const b = this.busqInv.toLowerCase();
      return this.inventario.filter(p=>(p.codigo+p.nombre+(p.categoria||'')).toLowerCase().includes(b));
    },

    abrirEditCliente(c) { this.editCliente=c; this.formC={...c}; this.modalCliente=true; },
    abrirEditInv(p) { this.editInv=p; this.formI={...p}; this.modalInv=true; },

    agregarAlCarrito(producto) {
      const item = this.carrito.find(p=>p.id===producto.id);
      if(item) {
        if(item.cantidad < producto.stock) item.cantidad++;
        else this.triggerToast('Stock insuficiente', 'error');
      } else {
        if(producto.stock>0) this.carrito.push({...producto, cantidad:1, precio:parseFloat(producto.precio1)});
        else this.triggerToast('Sin stock disponible', 'error');
      }
    },

    agregarPorBusqueda() {
      const q = this.posBusq.trim().toLowerCase();
      if(!q) return;
      let p = this.inventario.find(x=>x.codigo.toLowerCase()===q) || this.inventario.find(x=>x.nombre.toLowerCase()===q);
      if(!p) {
        const res = this.inventario.filter(x=>x.nombre.toLowerCase().includes(q)||x.codigo.toLowerCase().includes(q));
        if(res.length===1) p=res[0];
      }
      if(p) { this.agregarAlCarrito(p); this.posBusq=''; }
      else this.triggerToast('Producto no encontrado','error');
    },

    async guardarCliente() {
      if(!this.formC.razon||!this.formC.nroDoc){ alert('Razón Social y Documento son obligatorios'); return; }
      try {
        await this.apiFetch('/api/clientes','POST',this.formC);
        await this.refreshAll();
        this.modalCliente=false;
        this.triggerToast('Cliente guardado');
      } catch(e) { this.triggerToast('Error al guardar','error'); }
    },

    async eliminarCliente(id) {
      if(!confirm('¿Eliminar cliente?')) return;
      try { await this.apiFetch(`/api/clientes/${id}`,'DELETE'); await this.refreshAll(); this.triggerToast('Eliminado'); }
      catch(e) { this.triggerToast('Error','error'); }
    },

    async guardarProducto() {
      if(!this.formI.codigo||!this.formI.nombre){ alert('Código y Nombre son obligatorios'); return; }
      try {
        await this.apiFetch('/api/inventario','POST',this.formI);
        await this.refreshAll();
        this.modalInv=false;
        this.triggerToast('Producto guardado');
      } catch(e) { this.triggerToast('Error al guardar','error'); }
    },

    async eliminarProd(id) {
      if(!confirm('¿Eliminar producto?')) return;
      try { await this.apiFetch(`/api/inventario/${id}`,'DELETE'); await this.refreshAll(); this.triggerToast('Eliminado'); }
      catch(e) { this.triggerToast('Error','error'); }
    },

    async procesarVenta() {
      if(this.carrito.length===0) return;
      const total = this.totalCarrito();
      const rdm = Math.floor(Math.random()*9000)+1000;
      const ref = (this.posTipoComprobante==='Factura'?'F':(this.posTipoComprobante==='Boleta'?'B':'T'))+'001-'+rdm;
      let nombre = 'Cliente Genérico';
      if(this.posClienteId) { const c=this.clientes.find(x=>x.id==this.posClienteId); if(c) nombre=c.razon; }
      const d = new Date();
      const hm = d.getHours().toString().padStart(2,'0')+':'+d.getMinutes().toString().padStart(2,'0');
      const payload = { metodo:this.posMedioPago, concepto:`Venta (${this.posTipoComprobante}) - ${nombre}`, monto:total.toFixed(2), referencia:ref, fecha:d.toLocaleDateString()+' '+hm, carrito:this.carrito };
      try {
        await this.apiFetch('/api/venta','POST',payload);
        await this.refreshAll();
        this.triggerToast('Venta procesada: '+ref);
        this.carrito=[];
        this.posClienteId='';
        setTimeout(()=>alert(`COMPROBANTE GENERADO\n--------------------------\nDocumento: ${ref}\nCliente: ${nombre}\nTotal: S/ ${total.toFixed(2)}\nPago: ${this.posMedioPago}\n\n[Enviado a imprimir...]`),300);
      } catch(e) { this.triggerToast('Error al procesar venta','error'); }
    },

    async guardarMovimiento() {
      if(!this.formM.concepto||!this.formM.monto||parseFloat(this.formM.monto)<=0){ alert('Complete monto y concepto'); return; }
      try {
        const d=new Date(); const hm=d.getHours().toString().padStart(2,'0')+':'+d.getMinutes().toString().padStart(2,'0');
        await this.apiFetch('/api/venta','POST',{...this.formM, fecha:d.toLocaleDateString()+' '+hm, carrito:[]});
        await this.refreshAll();
        this.formM={tipo:this.formM.tipo,metodo:'Efectivo',concepto:'',monto:'',referencia:''};
        this.triggerToast('Movimiento registrado');
      } catch(e) { this.triggerToast('Error','error'); }
    }
  }
}
</script>

</body>
</html>
