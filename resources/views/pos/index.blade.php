<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demostración - AutoCars Cabrera</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google Fonts: Space Grotesk & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body x-data="app()" x-init="init()" class="antialiased selection:bg-primary/30 selection:text-white">

<div class="flex h-screen overflow-hidden">

  <!-- Sidebar removed as requested (Old interface) -->
  <!-- Main -->
  <div class="flex-1 flex flex-col overflow-hidden relative">
    
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-success/5 rounded-full blur-[100px] pointer-events-none"></div>

    <!-- Topbar -->
    <header class="px-10 py-6 flex items-center justify-between flex-shrink-0 z-10 border-b border-border-light bg-black/40 backdrop-blur-xl relative">
      <div>
        <h2 class="title text-3xl font-bold tracking-tight text-white capitalize flex items-center gap-3">
          <span x-text="{'panel':'Resumen General','clientes':'Directorio de Clientes','inventario':'Gestión de Inventario','caja':'Control de Caja'}[page]"></span>
          <div class="h-2 w-2 rounded-full bg-success animate-pulse-slow"></div>
        </h2>
        <p class="text-sm text-muted mt-1" x-show="page==='panel'">Visión unificada de las operaciones del día</p>
      </div>
      <div class="flex items-center gap-6">

        <!-- BOTON NUEVA VENTA (POS) -->
        <button class="btn-primary px-6 py-2.5 flex items-center gap-2 font-bold title tracking-wide" @click="abrirPOS()">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
          <span>NUEVA VENTA (TPV)</span>
        </button>

        <div class="h-8 w-px bg-border-light"></div>

        <div class="bg-surface border border-border-light px-4 py-2 flex items-center gap-3 rounded-lg shadow-inner">
          <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <span class="text-sm font-medium font-sans text-white/90">12 Marzo, 2026</span>
        </div>
        
        <button class="bg-surface hover:bg-white/10 p-2.5 rounded-lg border border-border-light text-muted hover:text-white transition-all shadow-glow group">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        </button>

      </div>
    </header>

    <!-- Content -->
    <main class="flex-1 overflow-y-auto px-10 py-8"> <!-- padding para alinear con header -->

              <table>
                <thead>
                    <tr>
                        <th class="w-24">Hora</th>
                        <th>Concepto</th>
                        <th>Cód/Ref</th>
                        <th class="text-right">Monto</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                  <template x-for="m in movimientos.slice().reverse().slice(0,6)">
                    <tr class="hover:bg-white/5 transition-colors group/row">
                      <td class="text-muted text-sm" x-text="m.fecha.split(' ')[1]"></td>
                      <td class="font-bold text-white group-hover/row:text-primary transition-colors" x-text="m.concepto"></td>
                      <td class="text-muted text-sm font-mono" x-text="m.referencia||' - '"></td>
                      <td class="font-bold text-right text-lg" :class="m.tipo==='ingreso'?'text-success':'text-primary'" x-text="(m.tipo==='ingreso'?'+S/ ':'-S/ ') + parseFloat(m.monto).toFixed(2)"></td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Alertas -->
          <div class="bg-card p-6 border-t-2 shadow-2xl relative overflow-hidden group" style="border-top-color: #FF2A4D;">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            
            <h3 class="title font-bold text-lg mb-6 flex items-center gap-2 text-white relative z-10">
              <div class="p-1.5 rounded-md bg-primary/20 text-primary border border-primary/30">
                  <svg class="w-5 h-5 animate-pulse-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
              </div>
              Reposición Urgente
            </h3>
            
            <div x-show="inventario.filter(i=>i.stock<=i.stockMin).length===0" class="text-center py-10 text-muted relative z-10">
              <div class="w-16 h-16 mx-auto rounded-full bg-success/10 text-success flex items-center justify-center mb-4 border border-success/20">
                  <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
              </div>
              <p class="font-medium text-white/80">Stock saludable.</p>
              <p class="text-sm mt-1">No hay alertas activas.</p>
            </div>

            <div class="space-y-3 relative z-10">
              <template x-for="p in inventario.filter(i=>i.stock<=i.stockMin).slice(0,5)">
                <div class="bg-base p-4 rounded-xl border border-border-light flex justify-between items-center group-alert hover:border-primary/50 hover:bg-white/5 transition-all cursor-pointer relative overflow-hidden" @click="page='inventario'; busqInv=p.codigo">
                  <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></div>
                  <div>
                    <p class="font-bold text-sm text-white mb-1 tracking-wide" x-text="p.nombre"></p>
                    <p class="text-xs text-muted font-mono" x-text="'Cód: ' + p.codigo"></p>
                  </div>
                  <div class="text-right">
                    <span class="badge badge-low shadow-glow border-primary/30" x-text="p.stock + ' ' + p.unidad"></span>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>

      <!-- ============ CLIENTES ============ -->
      <div x-show="page==='clientes'" class="space-y-6" x-transition.opacity style="display:none;">
        <div class="flex items-center justify-between bg-card p-4">
          <div class="relative w-96">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input x-model="busqCliente" placeholder="Buscar por nombre, RUC, o correo..." class="pl-10">
          </div>
          <button class="btn-primary py-2.5 px-5" @click="modalCliente=true;editCliente=null;formC={razon:'',comercial:'',tipoDoc:'RUC',nroDoc:'',telefono:'',email:'',direccion:'',distrito:'',ciudad:'Lima',credDias:0,limCredito:0,listaPrecio:'1',estado:'activo',notas:''}">
            + Añadir Cliente
          </button>
        </div>

        <div class="bg-card overflow-hidden shadow-2xl relative border border-border-light rounded-xl">
          <div class="absolute inset-0 bg-gradient-to-b from-white/5 to-transparent pointer-events-none"></div>
          <div x-show="clientesFiltrados().length===0" class="text-center py-16 text-muted relative z-10">
              <div class="w-16 h-16 mx-auto rounded-full bg-base flex items-center justify-center mb-4 border border-border-light shadow-inner">
                  <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
              </div>
              Ningún cliente coincide con la búsqueda.
          </div>
          <table x-show="clientesFiltrados().length>0" class="relative z-10 w-full">
            <thead>
                <tr>
                    <th class="text-left text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Identificación</th>
                    <th class="text-left text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Razón Social / Nombre</th>
                    <th class="text-left text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Contacto</th>
                    <th class="text-left text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Nivel</th>
                    <th class="text-left text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Estado</th>
                    <th class="text-right text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
              <template x-for="(c,i) in clientesFiltrados()">
                <tr class="hover:bg-white/5 transition-colors group/row">
                  <td class="py-4 px-6">
                    <span class="text-[10px] text-muted font-bold uppercase tracking-widest block mb-1" x-text="c.tipoDoc"></span>
                    <span class="font-display font-medium text-white tracking-wider" x-text="c.nroDoc"></span>
                  </td>
                  <td class="py-4 px-6">
                    <p class="font-bold text-white group-hover/row:text-primary transition-colors" x-text="c.razon"></p>
                    <p class="text-xs text-muted mt-1" x-text="c.comercial||'--'"></p>
                  </td>
                  <td class="py-4 px-6">
                    <p class="text-sm text-white/90" x-text="c.telefono||'--'"></p>
                    <p class="text-xs text-muted mt-1" x-text="c.email||'--'"></p>
                  </td>
                  <td class="py-4 px-6">
                      <span class="badge badge-warn shadow-glow border-accent/20 bg-accent/10" x-text="'Nivel ' + c.listaPrecio"></span>
                  </td>
                  <td class="py-4 px-6">
                      <span class="badge shadow-glow" :class="c.estado==='activo'?'badge-ok border-success/30':'badge-low border-primary/30'" x-text="c.estado"></span>
                  </td>
                  <td class="py-4 px-6 text-right">
                    <div class="flex justify-end gap-2 opacity-100 lg:opacity-0 group-hover/row:opacity-100 transition-opacity">
                      <button class="btn-ghost px-3 py-1.5 text-xs text-white hover:bg-white/10" @click="abrirEditCliente(c)">Editar</button>
                      <button class="btn-danger p-1.5 hover:bg-primary/80" @click="eliminarCliente(c.id)"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                    </div>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ============ INVENTARIO ============ -->
      <div x-show="page==='inventario'" class="space-y-6" x-transition.opacity style="display:none;">
        <div class="flex items-center justify-between bg-card p-4">
          <div class="relative w-96">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input x-model="busqInv" placeholder="Buscar código, producto o caetgoría..." class="pl-10">
          </div>
          <button class="btn-primary py-2.5 px-5" @click="modalInv=true;editInv=null;formI={codigo:'',nombre:'',categoria:'',marca:'',unidad:'unidad',precio1:'',precio2:'',precio3:'',stock:'',stockMin:'5',stockMax:'100',ubicacion:'',estado:'activo'}">
            + Nuevo Producto
          </button>
        </div>

        <div class="bg-card overflow-hidden shadow-2xl relative border border-border-light rounded-xl">
          <div class="absolute inset-0 bg-gradient-to-b from-white/5 to-transparent pointer-events-none"></div>
          <div x-show="invFiltrado().length===0" class="text-center py-16 text-muted relative z-10">
              <div class="w-16 h-16 mx-auto rounded-full bg-base flex items-center justify-center mb-4 border border-border-light shadow-inner">
                  <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
              </div>
              No encontramos productos con ese filtro.
          </div>
          <table x-show="invFiltrado().length>0" class="relative z-10 w-full">
            <thead>
                <tr>
                    <th class="text-left text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Código</th>
                    <th class="text-left text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Producto / Categoría</th>
                    <th class="text-left text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Inventario</th>
                    <th class="text-right text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Precio Base</th>
                    <th class="text-right text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Precio May</th>
                    <th class="text-center text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Estado</th>
                    <th class="text-right text-xs font-bold text-muted uppercase tracking-wider py-4 px-6">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
              <template x-for="(p,i) in invFiltrado()">
                <tr class="hover:bg-white/5 transition-colors group/row">
                  <td class="py-4 px-6">
                      <span class="font-display font-bold text-accent tracking-widest text-sm bg-accent/10 px-2 py-1 rounded border border-accent/20" x-text="p.codigo"></span>
                  </td>
                  <td class="py-4 px-6">
                    <p class="font-bold text-white group-hover/row:text-primary transition-colors text-base" x-text="p.nombre"></p>
                    <div class="flex items-center gap-2 mt-1.5">
                      <span class="text-[10px] uppercase font-bold text-muted tracking-wider" x-text="p.categoria"></span>
                      <span class="w-1 h-1 rounded-full bg-border-light"></span>
                      <span class="text-[10px] uppercase font-bold text-muted tracking-wider" x-text="p.marca"></span>
                    </div>
                  </td>
                  <td class="py-4 px-6">
                    <div class="flex flex-col items-start gap-1">
                      <span class="badge shadow-glow" :class="p.stock<=0?'badge-low border-primary/30':p.stock<=p.stockMin?'badge-warn border-accent/30 bg-accent/10 text-accent':'badge-ok border-success/30 bg-success/10 text-success'" x-text="p.stock+' '+p.unidad"></span>
                      <span x-show="p.stock<=p.stockMin" class="text-[9px] uppercase tracking-widest text-primary font-bold animate-pulse-slow">Poco Stock</span>
                    </div>
                  </td>
                  <td class="py-4 px-6 text-right">
                      <span class="font-bold text-white text-base" x-text="'S/ ' + parseFloat(p.precio1).toFixed(2)"></span>
                  </td>
                  <td class="py-4 px-6 text-right">
                      <span class="text-muted font-medium" x-text="'S/ ' + parseFloat(p.precio2).toFixed(2)"></span>
                  </td>
                  <td class="py-4 px-6 text-center">
                      <span class="badge shadow-glow" :class="p.estado==='activo'?'badge-ok border-success/30':'badge-low border-primary/30'" x-text="p.estado"></span>
                  </td>
                  <td class="py-4 px-6 text-right">
                    <div class="flex justify-end gap-2 opacity-100 lg:opacity-0 group-hover/row:opacity-100 transition-opacity">
                      <button class="btn-ghost px-3 py-1.5 text-xs text-white hover:bg-white/10" @click="abrirEditInv(p)">Editar</button>
                      <button class="btn-danger p-1.5 hover:bg-primary/80" @click="eliminarProd(p.id)"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                    </div>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ============ CAJA Y CIERRE ============ -->
      <div x-show="page==='caja'" class="space-y-6 animate-fade-in" style="display:none;">
        <div class="grid grid-cols-3 gap-6">
          <div class="kpi group border-t-2 relative overflow-hidden" style="border-top-color: #00E676;">
            <div class="absolute -right-10 -bottom-10 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
            </div>
            <div class="relative z-10 flex flex-col h-full justify-between pt-5">
                <p class="text-muted text-xs font-bold uppercase tracking-wider mb-2">Ingresos Totales</p>
                <p class="kpi-val text-success" style="text-shadow: 0 0 20px rgba(0,230,118,0.4);" x-text="'S/ '+movimientos.filter(m=>m.tipo==='ingreso').reduce((a,m)=>a+parseFloat(m.monto),0).toFixed(2)"></p>
            </div>
          </div>
          <div class="kpi group border-t-2 relative overflow-hidden" style="border-top-color: #FF2A4D;">
            <div class="absolute -right-10 -bottom-10 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
            </div>
            <div class="relative z-10 flex flex-col h-full justify-between pt-5">
                <p class="text-muted text-xs font-bold uppercase tracking-wider mb-2">Egresos Totales</p>
                <p class="kpi-val text-primary" style="text-shadow: 0 0 20px rgba(255,42,77,0.4);" x-text="'S/ '+movimientos.filter(m=>m.tipo==='egreso').reduce((a,m)=>a+parseFloat(m.monto),0).toFixed(2)"></p>
            </div>
          </div>
          <div class="kpi border-t-2 border-border-light pt-5 bg-gradient-to-br from-white/5 to-transparent relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            <div class="relative z-10 flex flex-col h-full justify-between">
                <p class="text-muted text-xs font-bold uppercase tracking-wider mb-2">Saldo Neto Efectivo en Caja</p>
                <p class="kpi-val text-white" x-text="'S/ '+saldoCaja().toFixed(2)"></p>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-3 gap-8">
          <!-- Form -->
          <div class="bg-card p-6 border border-border-light shadow-2xl relative overflow-hidden rounded-xl">
            <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent pointer-events-none"></div>
            <h3 class="title font-bold text-lg mb-6 text-white pb-3 border-b border-border-light relative z-10 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Registrar Operación
            </h3>
            <div class="space-y-5 relative z-10">
              <div>
                <label class="text-[10px] text-muted uppercase tracking-widest block mb-2 font-bold">Tipo de Operación</label>
                <div class="flex gap-2">
                  <button class="flex-1 py-2 rounded-lg text-sm font-bold transition-all border" :class="formM.tipo==='ingreso'?'bg-success/20 text-success border-success/50 shadow-glow':'bg-base border-border-light text-muted hover:border-border hover:bg-white/5'" @click="formM.tipo='ingreso'">Ingreso</button>
                  <button class="flex-1 py-2 rounded-lg text-sm font-bold transition-all border" :class="formM.tipo==='egreso'?'bg-primary/20 text-primary border-primary/50 shadow-glow':'bg-base border-border-light text-muted hover:border-border hover:bg-white/5'" @click="formM.tipo='egreso'">Egreso</button>
                </div>
              </div>
              <div>
                <label class="text-[10px] text-muted uppercase tracking-widest block mb-2 font-bold">Método Pago</label>
                <select x-model="formM.metodo" class="w-full">
                  <option>Efectivo</option>
                  <option>Transferencia</option>
                  <option>Tarjeta</option>
                  <option>Yape/Plin</option>
                </select>
              </div>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="text-[10px] text-muted uppercase tracking-widest block mb-2 font-bold">Monto Exacto (S/)</label>
                  <input type="number" step="0.01" x-model.number="formM.monto" placeholder="0.00" class="w-full text-right font-display font-bold text-2xl h-12 text-white">
                </div>
                <div>
                  <label class="text-[10px] text-muted uppercase tracking-widest block mb-2 font-bold">Ref / Doc (Opc.)</label>
                  <input x-model="formM.referencia" placeholder="F-001, B-223" class="w-full h-12">
                </div>
              </div>
              <div>
                <label class="text-[10px] text-muted uppercase tracking-widest block mb-2 font-bold">Concepto Corto</label>
                <input x-model="formM.concepto" placeholder="Ej: Venta #001, Pago luz..." class="w-full">
              </div>
              <button class="w-full py-4 rounded-lg font-bold title tracking-wide transition-all uppercase text-sm mt-4 text-white shadow-glow flex items-center justify-center gap-2" :class="formM.tipo==='ingreso' ? 'bg-success hover:bg-green-500' : 'bg-primary hover:bg-red-500'" @click="guardarMovimiento()">
                Guardar y Registrar <span x-text="formM.tipo"></span>
              </button>
            </div>
          </div>

          <!-- Historial -->
          <div class="col-span-2 bg-card overflow-hidden flex flex-col shadow-2xl relative border border-border-light rounded-xl group/card">
            <div class="absolute inset-0 bg-gradient-to-tl from-white/5 to-transparent pointer-events-none opacity-0 group-hover/card:opacity-100 transition-opacity duration-500"></div>
            <div class="p-6 border-b border-border-light flex items-center justify-between bg-surface relative z-10">
              <h3 class="title font-bold text-lg text-white flex items-center gap-2">
                 <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                 Flujo de Historial
              </h3>
              <button class="btn-ghost px-4 py-2 text-xs border border-primary text-primary hover:bg-primary hover:text-white" @click="if(confirm('¿Seguro de hacer cierre y limpiar pantalla?')){movimientos=[];guardar()}">
                Cerrar Turno (Limpiar)
              </button>
            </div>
            <div class="flex-1 overflow-y-auto relative z-10">
              <div x-show="movimientos.length===0" class="h-full flex flex-col items-center justify-center text-muted p-10">
                <div class="w-16 h-16 rounded-full bg-base flex items-center justify-center mb-4 border border-border-light shadow-inner">
                    <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <span>La caja está vacía ahora mismo.</span>
              </div>
              <table x-show="movimientos.length>0" class="w-full">
                <thead class="bg-black/20 border-b border-white/5">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-bold text-muted uppercase tracking-wider">Hora</th>
                        <th class="py-3 px-6 text-left text-xs font-bold text-muted uppercase tracking-wider">Glosa</th>
                        <th class="py-3 px-6 text-left text-xs font-bold text-muted uppercase tracking-wider">Ref.</th>
                        <th class="py-3 px-6 text-left text-xs font-bold text-muted uppercase tracking-wider">Forma</th>
                        <th class="py-3 px-6 text-right text-xs font-bold text-muted uppercase tracking-wider">Monto</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                  <template x-for="(m,i) in movimientos.slice().reverse()">
                    <tr class="hover:bg-white/5 transition-colors group/row">
                      <td class="py-3 px-6 text-muted text-xs font-mono" x-text="m.fecha"></td>
                      <td class="py-3 px-6 font-bold text-white group-hover/row:text-primary transition-colors" x-text="m.concepto"></td>
                      <td class="py-3 px-6 text-muted text-sm" x-text="m.referencia||'--'"></td>
                      <td class="py-3 px-6"><span class="badge border border-border-light shadow-glow text-muted uppercase tracking-wider text-[9px]" x-text="m.metodo"></span></td>
                      <td class="py-3 px-6 text-right font-display font-bold text-lg" :class="m.tipo==='ingreso'?'text-success':'text-primary'" x-text="(m.tipo==='ingreso'?'+S/ ':'-S/ ')+parseFloat(m.monto).toFixed(2)"></td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>

<!-- MODAL CLIENTE -->
<div class="modal-overlay" x-show="modalCliente" @click.self="modalCliente=false" x-transition.opacity style="display:none;">
  <div class="modal-box relative overflow-hidden" x-show="modalCliente" x-transition.scale.95>
    <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent pointer-events-none"></div>
    <div class="p-6 border-b border-border-light flex items-center justify-between relative z-10 bg-surface/50">
      <h3 class="title font-bold text-xl text-white flex items-center gap-2">
          <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
          <span x-text="editCliente?'Edición de Cliente':'Alta de Cliente'"></span>
      </h3>
      <button @click="modalCliente=false" class="text-muted hover:text-white bg-base hover:bg-white/10 p-2 rounded-lg transition-colors border border-transparent hover:border-border-light shadow-inner">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
      </button>
    </div>
    <div class="p-8 grid grid-cols-2 gap-5 relative z-10">
      <div class="col-span-2">
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Razón Social / Nombres completos *</label>
        <input x-model="formC.razon" placeholder="Escribe aquí el nombre..." class="w-full text-white">
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Tipo Doc.</label>
        <select x-model="formC.tipoDoc" class="w-full"><option>RUC</option><option>DNI</option><option>CE</option></select>
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">N° Documento *</label>
        <input x-model="formC.nroDoc" placeholder="Número válido" class="w-full font-display text-white">
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Teléfono/Celular</label>
        <input x-model="formC.telefono" placeholder="Opcional" class="w-full font-display">
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Email de Facturación</label>
        <input x-model="formC.email" placeholder="correo@ejemplo.com" class="w-full">
      </div>
      <div class="col-span-2">
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Dirección Fiscal / Entrega</label>
        <input x-model="formC.direccion" placeholder="Av. Los Pinos 123" class="w-full">
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Nivel Precio</label>
        <select x-model="formC.listaPrecio" class="w-full"><option value="1">Base (General)</option><option value="2">Nivel 2 (Mayorista)</option><option value="3">Nivel 3 (Especial)</option></select>
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Estado</label>
        <select x-model="formC.estado" class="w-full"><option value="activo">Activo Operando</option><option value="inactivo">Bloqueado/Inactivo</option></select>
      </div>
      <div class="col-span-2 flex gap-3 pt-6 border-t border-border-light mt-2">
        <button class="bg-primary hover:bg-primary/90 text-white shadow-[0_0_20px_rgba(255,42,77,0.3)] transition-all flex-1 py-3.5 rounded-lg text-sm font-bold uppercase tracking-wide border border-primary/50" @click="guardarCliente()">
          <span x-text="editCliente?'Guardar Cambios':'Confirmar y Registrar'"></span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL PRODUCTO -->
<div class="modal-overlay" x-show="modalInv" @click.self="modalInv=false" x-transition.opacity style="display:none;">
  <div class="modal-box relative overflow-hidden" x-show="modalInv" x-transition.scale.95>
    <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent pointer-events-none"></div>
    <div class="p-6 border-b border-border-light flex items-center justify-between relative z-10 bg-surface/50">
      <h3 class="title font-bold text-xl text-white flex items-center gap-2">
          <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
          <span x-text="editInv?'Edición de Producto':'Alta de Producto Nuevo'"></span>
      </h3>
      <button @click="modalInv=false" class="text-muted hover:text-white bg-base hover:bg-white/10 p-2 rounded-lg transition-colors border border-transparent hover:border-border-light shadow-inner">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
      </button>
    </div>
    <div class="p-8 grid grid-cols-3 gap-5 relative z-10">
      <div class="col-span-1">
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">SKU/Código *</label>
        <input x-model="formI.codigo" placeholder="ID único" class="w-full font-display font-medium text-accent">
      </div>
      <div class="col-span-2">
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Descripción del Producto *</label>
        <input x-model="formI.nombre" placeholder="Nombre visible en boleta" class="w-full font-bold text-white">
      </div>
      
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Cátegoria</label>
        <input x-model="formI.categoria" placeholder="Línea" class="w-full text-sm">
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Marca</label>
        <input x-model="formI.marca" placeholder="Fabricante" class="w-full text-sm">
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Unidad</label>
        <select x-model="formI.unidad" class="w-full text-sm"><option>Unidad</option><option>Kilo</option><option>Metro</option><option>Litro</option><option>Caja</option></select>
      </div>

      <div class="col-span-3 pt-6 border-t border-border-light relative">
          <h4 class="title font-bold text-white text-sm mb-4 flex items-center gap-2">
              <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              Escala de Precios
          </h4>
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">P. Base (S/)</label>
        <input type="number" step="0.01" x-model.number="formI.precio1" placeholder="Ej: 100.00" class="w-full text-success font-display font-bold text-lg">
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">P. Mayorista (S/)</label>
        <input type="number" step="0.01" x-model.number="formI.precio2" placeholder="Opcional" class="w-full font-display font-medium text-white/90 text-lg">
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">P. Especial (S/)</label>
        <input type="number" step="0.01" x-model.number="formI.precio3" placeholder="Opcional" class="w-full font-display text-lg">
      </div>

      <div class="col-span-3 pt-6 border-t border-border-light mt-2 relative">
          <h4 class="title font-bold text-white text-sm mb-4 flex items-center gap-2">
              <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
              Control de Inventario
          </h4>
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Stock Actual</label>
        <input type="number" x-model.number="formI.stock" placeholder="Qty" class="w-full font-display font-bold text-white text-lg">
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Mín. Alerta</label>
        <input type="number" x-model.number="formI.stockMin" placeholder="Aviso en: 5" class="w-full font-display text-primary font-medium text-lg">
      </div>
      <div>
        <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Estado</label>
        <select x-model="formI.estado" class="w-full text-sm h-12"><option value="activo">Vigente (Visible)</option><option value="inactivo">Oculto</option></select>
      </div>

      <div class="col-span-3 flex gap-3 pt-6 border-t border-border-light mt-2">
        <button class="bg-accent hover:bg-yellow-400 text-black shadow-[0_0_20px_rgba(255,184,0,0.3)] transition-all flex-1 py-3.5 rounded-lg text-sm font-bold uppercase tracking-wide border border-accent/50" @click="guardarProducto()">
          <span x-text="editInv?'Actualizar Producto':'Asentar Producto en Inventario'"></span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL POS (NUEVA VENTA) -->
<div class="modal-overlay backdrop-blur-sm" x-show="modalPos" @click.self="modalPos=false" x-transition.opacity style="display:none; z-index: 300;">
  <div class="modal-box relative overflow-hidden flex flex-col" style="max-width: 1200px; height: 90vh;" x-show="modalPos" x-transition.scale.95>
    <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent pointer-events-none"></div>
    <!-- Header POS -->
    <div class="p-6 border-b border-border-light flex items-center justify-between bg-surface flex-shrink-0 relative z-10">
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-primary/20 flex items-center justify-center text-primary border border-primary/30 shadow-glow">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
          <h3 class="title font-bold text-2xl text-white tracking-wide">TERMINAL POS</h3>
          <p class="text-[10px] text-primary font-bold uppercase tracking-widest mt-1 animate-pulse-slow">Nueva Venta Rápida</p>
        </div>
      </div>
      <button @click="modalPos=false" class="text-muted hover:text-white bg-base p-2 px-4 rounded-lg transition-colors border border-border hover:border-border-light shadow-inner flex items-center gap-2 text-xs font-bold uppercase tracking-wider">
          <span class="hidden sm:inline">Cerrar Terminal</span> ✕
      </button>
    </div>

    <!-- POS Body -->
    <div class="flex-1 flex overflow-hidden relative z-10">
      
      <!-- Left Area: Products -->
      <div class="flex-1 flex flex-col bg-base/80 border-r border-border-light relative backdrop-blur-xl">
        <div class="p-5 border-b border-border-light bg-surface/80">
          <div class="relative">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-6 h-6 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input x-model="posBusq" type="text" placeholder="Buscar por código o nombre del producto..." class="w-full pl-12 py-3.5 text-lg font-medium text-white" @keydown.enter.prevent="agregarPorBusqueda()">
          </div>
          <div class="flex gap-2 mt-4 overflow-x-auto pb-2" style="scrollbar-width: none;">
            <button class="badge px-5 py-2 text-[11px] font-bold uppercase tracking-widest hover:bg-white/10 transition-colors cursor-pointer" :class="posCategoria===''?'bg-primary text-white border-primary/50 shadow-[0_0_15px_rgba(255,42,77,0.4)]':'bg-surface border-border-light text-muted'" @click="posCategoria=''">Todos</button>
            <template x-for="cat in [...new Set(inventario.map(i=>i.categoria).filter(Boolean))]">
              <button class="badge px-5 py-2 text-[11px] font-bold uppercase tracking-widest transition-colors cursor-pointer" @click="posCategoria=cat" :class="posCategoria===cat?'bg-white/20 text-white border-white/30 shadow-inner':'bg-surface border-border-light text-muted hover:bg-white/10 hover:text-white'" x-text="cat"></button>
            </template>
          </div>
        </div>
        
        <div class="flex-1 overflow-y-auto p-5">
          <div class="grid grid-cols-2 lg:grid-cols-3 gap-5">
            <template x-for="p in inventario.filter(i => (!posCategoria || i.categoria === posCategoria) && (i.nombre.toLowerCase().includes(posBusq.toLowerCase()) || i.codigo.toLowerCase().includes(posBusq.toLowerCase())))">
              <div class="bg-card border border-border-light rounded-xl p-5 cursor-pointer hover:border-accent hover:shadow-[0_0_15px_rgba(255,184,0,0.2)] hover:-translate-y-1 transition-all group flex flex-col h-full relative overflow-hidden" @click="agregarAlCarrito(p)">
                <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute top-0 right-0 p-3">
                  <span class="badge shadow-glow" :class="p.stock<=0?'badge-low border-primary/30':p.stock<=p.stockMin?'badge-warn border-accent/30 bg-accent/10 text-accent':'bg-base text-muted border-border-light text-[10px]'" x-text="p.stock + ' ud'"></span>
                </div>
                <div class="w-14 h-14 bg-base rounded-full shadow-inner border border-border-light flex items-center justify-center text-muted mb-4 group-hover:text-accent group-hover:border-accent/50 transition-colors relative z-10">
                  <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <p class="font-bold text-sm text-white mb-2 line-clamp-2 flex-1 relative z-10 group-hover:text-accent transition-colors" x-text="p.nombre"></p>
                <div class="flex items-end justify-between mt-3 pt-3 border-t border-white/10 relative z-10">
                  <p class="text-[10px] uppercase font-bold tracking-widest text-muted" x-text="p.codigo"></p>
                  <p class="font-display font-bold text-white text-xl" x-text="'S/ ' + parseFloat(p.precio1).toFixed(2)"></p>
                </div>
              </div>
            </template>
            <div x-show="inventario.filter(i => (!posCategoria || i.categoria === posCategoria) && (i.nombre.toLowerCase().includes(posBusq.toLowerCase()) || i.codigo.toLowerCase().includes(posBusq.toLowerCase()))).length === 0" class="col-span-full py-16 text-center">
              <div class="w-16 h-16 mx-auto rounded-full bg-base flex items-center justify-center mb-4 border border-border-light shadow-inner">
                  <svg class="w-8 h-8 text-muted opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
              </div>
              <p class="text-muted font-medium">No se encontraron productos que coincidan con la búsqueda.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Area: Cart -->
      <div class="w-[420px] flex flex-col bg-surface/90 backdrop-blur-xl flex-shrink-0">
        <!-- Client Selection -->
        <div class="p-5 border-b border-border-light bg-base/50">
          <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Cliente Asociado a Venta</label>
          <select x-model="posClienteId" class="w-full text-sm font-medium text-white/90">
            <option value="">Cliente Genérico (Boleta)</option>
            <template x-for="c in clientes">
              <option :value="c.id" x-text="c.razon + ' (' + c.nroDoc + ')'"></option>
            </template>
          </select>
        </div>

        <!-- Order Items -->
        <div class="flex-1 overflow-y-auto p-0 scroll-smooth">
          <div class="px-5 py-3.5 bg-base/80 backdrop-blur-md border-b border-border-light flex justify-between items-center sticky top-0 z-20">
            <span class="text-[10px] font-bold text-muted uppercase tracking-widest">Detalle de Orden</span>
            <button @click="carrito=[]" class="text-[10px] font-bold uppercase tracking-widest text-primary hover:text-white transition-colors flex items-center gap-1" x-show="carrito.length>0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Vacíar Todo
            </button>
          </div>
          
          <div x-show="carrito.length===0" class="flex flex-col items-center justify-center p-10 h-64 text-muted text-center">
             <div class="w-16 h-16 rounded-full bg-base flex items-center justify-center mb-4 border border-border-light shadow-inner">
                 <svg class="w-8 h-8 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
             </div>
             <p class="text-sm font-medium">El carrito está vacío.<br>Seleccione productos a la izquierda.</p>
          </div>

          <div class="divide-y divide-white/5">
            <template x-for="(item, index) in carrito" :key="index">
              <div class="p-5 hover:bg-white/5 transition-colors group/item">
                <div class="flex justify-between items-start mb-3">
                  <div class="flex-1 pr-3">
                    <p class="text-sm font-bold text-white leading-tight" x-text="item.nombre"></p>
                    <p class="text-[10px] uppercase font-bold tracking-widest text-muted mt-1.5" x-text="item.codigo"></p>
                  </div>
                  <button @click="carrito.splice(index,1)" class="text-muted hover:text-primary transition-colors p-1.5 rounded bg-base border border-border-light opacity-0 group-hover/item:opacity-100">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                  </button>
                </div>
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-1 bg-base rounded-lg border border-border-light p-1 shadow-inner w-fit">
                    <button @click="if(item.cantidad>1) item.cantidad--" class="w-7 h-7 flex items-center justify-center text-white hover:bg-white/10 rounded-md font-display transition-colors">-</button>
                    <input type="number" x-model.number="item.cantidad" class="w-12 text-center bg-transparent border-none p-0 text-sm font-bold font-display" min="1" @change="if(item.cantidad<1) item.cantidad=1">
                    <button @click="item.cantidad++" class="w-7 h-7 flex items-center justify-center text-white hover:bg-white/10 rounded-md font-display transition-colors">+</button>
                  </div>
                  <div class="text-right">
                    <p class="font-display font-bold text-lg text-white" x-text="'S/ ' + (item.precio * item.cantidad).toFixed(2)"></p>
                    <p class="text-[10px] font-bold text-muted uppercase tracking-widest mt-0.5" x-text="'S/ '+ parseFloat(item.precio).toFixed(2) +' c/u'"></p>
                  </div>
                </div>
              </div>
            </template>
          </div>
        </div>

        <!-- Totals & Checkout -->
        <div class="p-6 bg-card border-t border-border-light flex-shrink-0 relative">
          <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-transparent via-primary/20 to-transparent"></div>
          <div class="space-y-3 mb-6">
            <div class="flex justify-between text-sm text-muted font-medium">
              <span>Subtotal</span>
              <span class="font-display text-white/90" x-text="'S/ ' + (calcularTotalDescuentoDesdeCarrito() / 1.18).toFixed(2)"></span>
            </div>
            <div class="flex justify-between text-sm text-muted font-medium">
              <span>IGV (18%)</span>
              <span class="font-display text-white/90" x-text="'S/ ' + (calcularTotalDescuentoDesdeCarrito() - (calcularTotalDescuentoDesdeCarrito() / 1.18)).toFixed(2)"></span>
            </div>
            <div class="flex justify-between items-end pt-4 border-t border-white/10 mt-2">
              <span class="text-[10px] font-bold uppercase tracking-widest text-muted mb-1">Total a Pagar</span>
              <span class="text-3xl font-display font-bold text-success" style="text-shadow: 0 0 20px rgba(0,230,118,0.4);" x-text="'S/ ' + calcularTotalDescuentoDesdeCarrito().toFixed(2)"></span>
            </div>
          </div>
          
          <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
               <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Tipo Comp.</label>
               <select x-model="posTipoComprobante" class="w-full text-sm font-medium">
                 <option value="Boleta">Boleta (B)</option>
                 <option value="Factura">Factura (F)</option>
                 <option value="Ticket">Ticket Int.</option>
               </select>
            </div>
            <div>
               <label class="text-[10px] text-muted uppercase tracking-widest block mb-1.5 font-bold">Medio de Pago</label>
               <select x-model="posMedioPago" class="w-full text-sm font-medium">
                 <option value="Efectivo">Efectivo 💵</option>
                 <option value="Yape/Plin">Yape / Plin 📱</option>
                 <option value="Tarjeta">POS Tarjeta 💳</option>
                 <option value="Transferencia">Transferencia 🏦</option>
               </select>
            </div>
          </div>

          <button class="w-full py-4 rounded-xl text-sm font-bold uppercase tracking-wide transition-all shadow-glow flex items-center justify-center gap-3" :disabled="carrito.length===0" :class="carrito.length===0?'bg-base border border-border-light text-muted cursor-not-allowed':'bg-primary hover:bg-primary/90 text-white shadow-[0_0_20px_rgba(255,42,77,0.4)] border border-primary/50 hover:-translate-y-0.5'" @click="procesarVenta()">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            COBRAR E IMPRIMIR
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Toast Notif -->
<div x-show="toast.show" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" class="fixed bottom-8 right-8 z-[1000] py-4 px-6 rounded-xl bg-surface/90 backdrop-blur-xl border border-border-light flex items-center gap-4 shadow-glow" style="display:none;">
  <div class="w-2.5 h-2.5 rounded-full animate-pulse-slow shadow-glow" :class="toast.type==='error'?'bg-primary shadow-[0_0_10px_rgba(255,42,77,0.8)]':'bg-success shadow-[0_0_10px_rgba(0,230,118,0.8)]'"></div>
  <span class="font-bold text-white text-sm tracking-wide" x-text="toast.msg"></span>
</div>

<script>
function app() {
  return {
    // State
    page: 'pos', // This is what powers the view rendering now
    
    // POS State
    inventario: [],
    clientes: [],
    carrito: [],
    movimientos: [],

    // Filters & UI State
    busqInv: '',
    busqCliente: '',
    busqCaja: '',
    posBusq: '',
    posCategoria: '',
    posMedioPago: 'Efectivo',
    posTipoComprobante: 'Boleta',
    posClienteId: '',

    // Modals & UI
    modalPos: false,
    modalCliente: false,
    modalInv: false,
    toastMsg: '',
    toastTipo: 'info',
    showToast: false,

    // Forms
    editCliente: null,
    formC: { razon: '', comercial: '', tipoDoc: 'DNI', nroDoc: '', telefono: '', email: '', direccion: '', distrito: '', ciudad: '', credDias: 0, limCredito: 0, listaPrecio: '1', estado: 'activo', notas: '' },

    editInv: null,
    formI: { codigo: '', nombre: '', categoria: 'Lubricantes', marca: '', unidad: 'Unidad', precio1: '', precio2: '', precio3: '', stock: 0, stockMin: 0, stockMax: 0, ubicacion: '', estado: 'activo' },

    formM: { tipo: 'ingreso', metodo: 'Efectivo', concepto: '', monto: '', referencia: '' },

    async init() {
      // CSRF setup for all fetches
      const metaToken = document.querySelector('meta[name="csrf-token"]');
      this.csrfToken = metaToken ? metaToken.getAttribute('content') : '';
      await this.refreshAll();
      
      const params = new URLSearchParams(window.location.search);
      if (params.get('pos') === 'true') {
         this.modalPos = true;
         this.carrito = [];
         this.posBusq = '';
         this.posCategoria = '';
         this.posClienteId = '';
         this.posTipoComprobante = 'Boleta';
         this.posMedioPago = 'Efectivo';
      }
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
      } catch (e) {
        this.triggerToast('Error conectando con el servidor', 'error');
      }
    },

    async apiFetch(url, method = 'GET', data = null) {
      const options = {
        method,
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': this.csrfToken,
          'Accept': 'application/json'
        }
      };
      if (data) options.body = JSON.stringify(data);
      
      const res = await fetch(url, options);
      if (!res.ok) throw new Error('Error en la petición');
      return await res.json();
    },

    triggerToast(m, t = 'info') {
      this.toastMsg = m; this.toastTipo = t; this.showToast = true;
      setTimeout(() => this.showToast = false, 3000);
    },

    async guardarCliente() {
      if(!this.formC.razon || !this.formC.nroDoc) { alert('Razón Social y Documento requeridos.'); return; }
      try {
        await this.apiFetch('/api/clientes', 'POST', this.formC);
        await this.refreshAll();
        this.modalCliente = false;
        this.triggerToast('Cliente actualizado');
      } catch (e) { this.triggerToast('Error al guardar cliente', 'error'); }
    },

    async eliminarCliente(id) {
      if(!confirm('¿Eliminar registro permamente?')) return;
      try {
        await this.apiFetch(`/api/clientes/${id}`, 'DELETE');
        await this.refreshAll();
        this.triggerToast('Registro borrado');
      } catch (e) { this.triggerToast('Error al borrar', 'error'); }
    },

    async guardarProducto() {
      if(!this.formI.codigo || !this.formI.nombre){ alert('Código y Nombre requeridos'); return; }
      try {
        await this.apiFetch('/api/inventario', 'POST', this.formI);
        await this.refreshAll();
        this.modalInv = false;
        this.triggerToast('Inventario actualizado');
      } catch (e) { this.triggerToast('Error al actualizar inventario', 'error'); }
    },

    async eliminarProd(id) {
      if(!confirm('¿Borrar ítem del catálogo?')) return;
      try {
        await this.apiFetch(`/api/inventario/${id}`, 'DELETE');
        await this.refreshAll();
        this.triggerToast('Item eliminado');
      } catch (e) { this.triggerToast('Error al eliminar', 'error'); }
    },

    async procesarVenta() {
      if (this.carrito.length === 0) return;

      const totalVenta = this.carrito.reduce((acc, item) => acc + (item.precio * item.cantidad), 0);
      const rdm = Math.floor(Math.random() * 9000) + 1000;
      const refComprobante = (this.posTipoComprobante === 'Factura' ? 'F' : (this.posTipoComprobante === 'Boleta' ? 'B' : 'T')) + '001-' + rdm;
      
      let nombreCliente = 'Cliente Genérico';
      if(this.posClienteId) {
        const c = this.clientes.find(x=>x.id == this.posClienteId);
        if(c) nombreCliente = c.razon || 'Cliente ' + c.nroDoc;
      }

      const d = new Date();
      const hm = d.getHours().toString().padStart(2,'0')+':'+d.getMinutes().toString().padStart(2,'0');
      const payload = {
        metodo: this.posMedioPago,
        concepto: `Venta (${this.posTipoComprobante}) - ${nombreCliente}`,
        monto: totalVenta.toFixed(2),
        referencia: refComprobante,
        fecha: d.toLocaleDateString()+' '+hm,
        carrito: this.carrito
      };

      try {
        await this.apiFetch('/api/venta', 'POST', payload);
        await this.refreshAll();
        this.triggerToast(`Venta procesada con éxito: ${refComprobante}`);
        this.modalPos = false;
        this.carrito = [];
        this.posClienteId = '';
        
        setTimeout(() => {
          alert(`COMPROBANTE GENERADO:\n--------------------------\nDocumento: ${refComprobante}\nCliente: ${nombreCliente}\nMonto Total: S/ ${totalVenta.toFixed(2)}\nForma de Pago: ${this.posMedioPago}\n\n[El recibo se ha enviado a imprimir...]`);
        }, 500);
      } catch (e) { this.triggerToast('Error al procesar la venta', 'error'); }
    },

    async guardarMovimiento() {
      if(!this.formM.concepto || !this.formM.monto || parseFloat(this.formM.monto)<=0) { alert('Verifique el monto y el concepto de la operación'); return; }
      try {
        const d=new Date(); const hm = d.getHours().toString().padStart(2,'0')+':'+d.getMinutes().toString().padStart(2,'0');
        const payload = {...this.formM, fecha: d.toLocaleDateString()+' '+hm, carrito: []};
        await this.apiFetch('/api/venta', 'POST', payload);
        await this.refreshAll();
        this.formM={tipo:this.formM.tipo,metodo:'Efectivo',concepto:'',monto:'',referencia:''}; 
        this.triggerToast('Movimiento registrado');
      } catch (e) { this.triggerToast('Error al registrar movimiento', 'error'); }
    },

    clientesFiltrados(){ const b=this.busqCliente.toLowerCase(); return this.clientes.filter(c=>(c.razon+c.nroDoc+c.email).toLowerCase().includes(b)); },
    abrirEditCliente(c){ this.editCliente=c; this.formC={...c}; this.modalCliente=true; },
    invFiltrado(){ const b=this.busqInv.toLowerCase(); return this.inventario.filter(p=>(p.codigo+p.nombre+p.categoria).toLowerCase().includes(b)); },
    abrirEditInv(p){ this.editInv=p; this.formI={...p}; this.modalInv=true; },
    totalVentasHoy(){ return this.movimientos.filter(m=>m.tipo==='ingreso').reduce((a,m)=>a+parseFloat(m.monto),0); },
    saldoCaja(){ return this.movimientos.reduce((a,m)=>m.tipo==='ingreso'?a+parseFloat(m.monto):a-parseFloat(m.monto),0); },
    
    agregarAlCarrito(producto) {
      const item = this.carrito.find(p => p.id === producto.id);
      if (item) {
          if(item.cantidad < producto.stock) item.cantidad++;
          else this.triggerToast('Stock insuficiente', 'warning');
      } else {
          if(producto.stock > 0) this.carrito.push({...producto, cantidad: 1, precio: producto.precio1});
          else this.triggerToast('Sin stock disponible', 'error');
      }
    },

    eliminarDelCarrito(id) {
      this.carrito = this.carrito.filter(item => item.id !== id);
    },

    agregarPorBusqueda() {
        const query = this.posBusq.trim().toLowerCase();
        if(!query) return;
        let producto = this.inventario.find(p => p.codigo.toLowerCase() === query);
        if(!producto) producto = this.inventario.find(p => p.nombre.toLowerCase() === query);
        if(!producto) {
             const resultados = this.inventario.filter(p => !this.posCategoria || p.categoria === this.posCategoria).filter(p => (p.nombre.toLowerCase().includes(query) || p.codigo.toLowerCase().includes(query)));
             if(resultados.length === 1) producto = resultados[0];
        }
        if(producto) {
            this.agregarAlCarrito(producto);
            this.posBusq = '';
        } else {
            this.triggerToast('Producto no encontrado', 'error');
        }
    }
  }
}
</script>

</body>
</html>
