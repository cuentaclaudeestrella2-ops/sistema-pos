<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Panel — AutoCars Cabrera</title>
<script>
    tailwind.config = {
        corePlugins: { preflight: false }
    }
</script>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cabinet+Grotesk:wght@400;500;600;700;800&family=Geist+Mono:wght@400;500&family=JetBrains+Mono:wght@400;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{
    /* neutrals — elegant dark indigo/slate */
    --bg:       #0d1017;
    --s1:       #151923;
    --s2:       #1a1f2c;
    --s3:       #212736;
    --s4:       #2b3345;
    --b0:       rgba(255,255,255,0.055);
    --b1:       rgba(255,255,255,0.09);
    --b2:       rgba(255,255,255,0.14);
    /* brand - soft translucent blue */
    --brand:    #60a5fa;
    --brand2:   #3b82f6;
    --brand-a:  rgba(96,165,250,0.15);
    --brand-glow: rgba(96,165,250,0.25);
    /* red for alerts */
    --red:      #ef4444;
    --red2:     #dc2626;
    --red-a:    rgba(239,68,68,0.14);
    --red-glow: rgba(239,68,68,0.22);
    /* status */
    --green:    #23d18b;
    --green-a:  rgba(35,209,139,0.12);
    --amber:    #f5a623;
    --amber-a:  rgba(245,166,35,0.12);
    --blue:     #4a9eff;
    --blue-a:   rgba(74,158,255,0.12);
    /* text */
    --t0:   #f5f5f6;
    --t1:   #9898a6;
    --t2:   #52525f;
    /* layout */
    --sw:   260px;
    --font: 'Cabinet Grotesk', sans-serif;
    --mono: 'Geist Mono', monospace;
}
html,body{height:100%;background:var(--bg);color:var(--t0);font-family:var(--font);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased;}
button{font-family:inherit;cursor:pointer;border:none;background:none;}
input,select{font-family:inherit;}
a{text-decoration:none;color:inherit;}

/* @media print */
@media print {
    body * { visibility: hidden; }
    .print-area, .print-area * { visibility: visible; }
    .print-area { position: absolute; left: 0; top: 0; width: 100%; margin: 0; padding: 0; }
    @page { margin: 0; size: 80mm 200mm; }
}

::-webkit-scrollbar{width:3px;}::-webkit-scrollbar-thumb{background:var(--s4);border-radius:2px;}

/* ── LAYOUT ── */
.app{display:flex;min-height:100vh;position:relative;background:var(--bg);z-index:1;}
.app::before{
    content:'';
    position:fixed;top:-15%;left:-5%;width:50vw;height:50vw;
    background: radial-gradient(circle, rgba(96,165,250,0.08) 0%, transparent 60%);
    filter: blur(80px);
    pointer-events: none;
    z-index:-1;
}
.app::after{
    content:'';
    position:fixed;bottom:-20%;right:-10%;width:60vw;height:60vw;
    background: radial-gradient(circle, rgba(35,209,139,0.06) 0%, transparent 50%);
    filter: blur(100px);
    pointer-events: none;
    z-index:-1;
}

/* ── SIDEBAR ── */
.sb{
    width:var(--sw);flex-shrink:0;
    background:var(--s1);
    border-right:1px solid var(--b0);
    display:flex;flex-direction:column;
    padding:0;
    position:fixed;inset:0 auto 0 0;
    z-index:50;
}

.sb-logo{
    padding:22px 20px 20px;
    display:flex;align-items:center;gap:10px;
    border-bottom:1px solid var(--b0);
}
.sb-logo-mark{
    width:34px;height:34px;border-radius:9px;
    background:var(--brand-a);
    display:flex;align-items:center;justify-content:center;
    flex-shrink:0;
}
.sb-logo-mark svg{width:17px;height:17px;color:var(--brand);}
.sb-logo-text{font-size:14px;font-weight:800;letter-spacing:-.3px;line-height:1.2;}
.sb-logo-text span{color:var(--red);}
.sb-logo-text small{display:block;font-size:9.5px;font-weight:500;color:var(--t2);letter-spacing:.3px;margin-top:1px;}

.sb-mini{
    padding:14px 20px 10px;
    display:grid;grid-template-columns:1fr 1fr;gap:8px;
    border-bottom:1px solid var(--b0);
}
.sb-mini-card{
    background:var(--s2);border:1px solid var(--b0);
    border-radius:8px;padding:10px 11px;
}
.sb-mini-v{font-size:17px;font-weight:800;letter-spacing:-.5px;font-family:var(--mono);}
.sb-mini-l{font-size:10px;color:var(--t2);margin-top:2px;font-weight:500;}

.sb-nav{padding:12px 10px;flex:1;}
.nav-section{margin-bottom:4px;}
.nav-sec-lbl{font-size:9.5px;letter-spacing:1.2px;text-transform:uppercase;color:var(--t2);font-weight:600;padding:6px 10px 4px;}

.nav-item{
    display:flex;align-items:center;gap:9px;
    padding:8px 10px;border-radius:7px;
    font-size:13px;font-weight:500;color:var(--t1);
    cursor:pointer;transition:all .14s;position:relative;
    border:none;background:none;width:100%;text-align:left;
}
.nav-item svg{width:15px;height:15px;flex-shrink:0;opacity:.7;}
.nav-item:hover{color:var(--t0);background:var(--b0);}
.nav-item.active{color:var(--t0);background:var(--s3);}
.nav-item.active svg{opacity:1;}
.nav-item.active::before{
    content:'';position:absolute;left:0;top:4px;bottom:4px;
    width:2.5px;border-radius:0 2px 2px 0;background:var(--red);
}
.nav-badge{
    margin-left:auto;background:var(--red);color:#fff;
    font-size:9.5px;font-weight:700;
    padding:2px 6px;border-radius:10px;min-width:18px;text-align:center;
}

.sb-bottom{
    padding:14px 16px;
    border-top:1px solid var(--b0);
}
.user-row{display:flex;align-items:center;gap:9px;}
.user-av{
    width:30px;height:30px;border-radius:50%;
    background:linear-gradient(135deg,var(--red2),var(--red));
    display:flex;align-items:center;justify-content:center;
    font-size:11px;font-weight:800;color:#fff;flex-shrink:0;
}
.user-name{font-size:12px;font-weight:600;line-height:1.2;}
.user-role{font-size:10px;color:var(--t2);}

.btn-venta{
    margin:0 12px 14px;
    background:var(--brand);color:#fff;border-radius:9px;
    padding:11px 16px;font-size:13px;font-weight:700;
    display:flex;align-items:center;justify-content:center;gap:7px;
    transition:all .15s;letter-spacing:-.1px;
    position:relative;overflow:hidden;
}
.btn-venta::after{
    content:'';position:absolute;inset:0;
    background:rgba(255,255,255,0);transition:background .15s;
}
.btn-venta:hover::after{background:rgba(255,255,255,0.07);}
.btn-venta svg{width:14px;height:14px;}

/* ── MAIN ── */
.main{margin-left:var(--sw);flex:1;display:flex;flex-direction:column;}

/* ── TOPBAR ── */
.topbar{
    height:58px;padding:0 32px;
    display:flex;align-items:center;justify-content:space-between;
    border-bottom:1px solid var(--b0);
    background:var(--s1);
    position:sticky;top:0;z-index:40;
}
.topbar-left{}
.topbar-title{font-size:16px;font-weight:800;letter-spacing:-.4px;}
.topbar-sub{font-size:11.5px;color:var(--t2);font-weight:500;margin-top:1px;}
.topbar-right{display:flex;align-items:center;gap:10px;}

.topbar-date{
    font-size:12px;color:var(--t1);
    background:var(--s2);border:1px solid var(--b0);
    border-radius:7px;padding:6px 12px;
    display:flex;align-items:center;gap:6px;
}
.topbar-date svg{width:13px;height:13px;color:var(--t2);}

.topbar-btn{
    width:34px;height:34px;border-radius:8px;
    background:var(--s2);border:1px solid var(--b0);
    display:flex;align-items:center;justify-content:center;
    color:var(--t1);transition:all .14s;position:relative;
}
.topbar-btn svg{width:15px;height:15px;}
.topbar-btn:hover{background:var(--s3);color:var(--t0);}
.notif-dot{
    position:absolute;top:6px;right:6px;
    width:6px;height:6px;border-radius:50%;
    background:var(--red);border:1.5px solid var(--s1);
}

.btn-tpv{
    background:var(--brand-a);color:var(--brand);border-radius:8px;
    padding:8px 16px;font-size:12.5px;font-weight:700;
    display:flex;align-items:center;gap:6px;
    transition:all .15s;letter-spacing:-.1px;
}
.btn-tpv:hover{background:var(--brand);color:var(--bg);}
.btn-tpv svg{width:13px;height:13px;}

/* ── CONTENT ── */
.content{padding:28px 32px;flex:1;}

/* ── KPI GRID ── */
.kpi-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:32px;
}

.kpi{
    background: linear-gradient(150deg, rgba(255,255,255,0.03), rgba(255,255,255,0.005));
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border: 1px solid rgba(255,255,255,0.04);
    border-radius: 20px;
    padding: 24px 26px;
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
    box-shadow: 
        inset 0 1px 0 rgba(255,255,255,0.08), 
        0 8px 32px rgba(0,0,0,0.25);
    cursor: default;
}
.kpi:hover{
    transform: translateY(-4px);
    border-color: rgba(255,255,255,0.12);
    box-shadow: 
        inset 0 1px 0 rgba(255,255,255,0.15), 
        0 14px 44px rgba(0,0,0,0.4);
}

/* top accent line */
.kpi::before{
    content:'';
    position:absolute;top:0;left:0;right:0;height:1.5px;
    background:linear-gradient(90deg,transparent,var(--kpi-accent,var(--b1)),transparent);
    border-radius:20px 20px 0 0;
    opacity: 0.8;
}
.kpi::after {
    content:'';
    position:absolute;top:-50%;left:-50%;width:200%;height:200%;
    background: radial-gradient(circle at top right, var(--kpi-accent, transparent), transparent 50%);
    opacity: 0.08;
    pointer-events: none;
    transition: opacity 0.3s ease;
}
.kpi:hover::after { opacity: 0.15; }

.kpi.k-green{--kpi-accent:var(--green);}
.kpi.k-red{--kpi-accent:var(--red);}
.kpi.k-amber{--kpi-accent:var(--amber);}
.kpi.k-blue{--kpi-accent:var(--blue);}

/* large background number - REMOVED for premium look */
.kpi-bg{ display: none; }

.kpi-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;position:relative;z-index:2;}
.kpi-label{font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--t2);font-weight:700;}
.kpi-icon{
    width:36px;height:36px;border-radius:10px;
    display:flex;align-items:center;justify-content:center;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
}
.kpi-icon svg{width:16px;height:16px;}
.kpi-icon.green{background:var(--green-a);color:var(--green); box-shadow: 0 4px 12px rgba(35,209,139,0.2), inset 0 1px 0 rgba(255,255,255,0.1);}
.kpi-icon.red{background:var(--red-a);color:var(--red); box-shadow: 0 4px 12px rgba(239,68,68,0.2), inset 0 1px 0 rgba(255,255,255,0.1);}
.kpi-icon.amber{background:var(--amber-a);color:var(--amber); box-shadow: 0 4px 12px rgba(245,166,35,0.2), inset 0 1px 0 rgba(255,255,255,0.1);}
.kpi-icon.blue{background:var(--blue-a);color:var(--blue); box-shadow: 0 4px 12px rgba(74,158,255,0.2), inset 0 1px 0 rgba(255,255,255,0.1);}

.kpi-value{
    font-size:32px;font-weight:700;letter-spacing:-1px;
    line-height:1;margin-bottom:12px;font-family:var(--font);
    position:relative;z-index:2;
}
.kpi-footer{display:flex;align-items:center;gap:8px;position:relative;z-index:2;}
.kpi-badge{
    font-size:11px;font-weight:600;
    padding:3px 10px;border-radius:6px;
    display:inline-flex;align-items:center;gap:4px;
}
.kpi-badge.green{background:var(--green-a);color:var(--green);}
.kpi-badge.red{background:var(--red-a);color:var(--red);}
.kpi-badge.amber{background:var(--amber-a);color:var(--amber);}
.kpi-badge.blue{background:var(--blue-a);color:var(--blue);}
.kpi-sub{font-size:11.5px;color:var(--t2);font-weight:500;}

/* sparkline */
.kpi-spark{
    position:absolute;bottom:0;left:0;right:0;height:44px;
    opacity:0.3;pointer-events:none;z-index:1;
}

/* ── BOTTOM GRID ── */
.bottom-grid{
    display:grid;
    grid-template-columns:1fr 380px;
    gap:16px;
}

/* ── CARD ── */
.card{
    background:var(--s1);
    border:1px solid var(--b0);
    border-radius:13px;
    overflow:hidden;
}
.card-head{
    padding:18px 22px;
    border-bottom:1px solid var(--b0);
    display:flex;align-items:center;justify-content:space-between;
}
.card-title{font-size:13px;font-weight:700;letter-spacing:-.2px;}
.card-link{
    font-size:12px;color:var(--t2);
    display:flex;align-items:center;gap:4px;
    transition:color .14s;
}
.card-link:hover{color:var(--t0);}
.card-link svg{width:12px;height:12px;}

/* ── MOVIMIENTOS ── */
.mov-empty{
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    padding:52px 20px;color:var(--t2);text-align:center;
}
.mov-empty svg{width:36px;height:36px;margin-bottom:12px;opacity:.3;}
.mov-empty p{font-size:13px;}

.mov-item{
    display:flex;align-items:center;gap:14px;
    padding:13px 22px;
    border-bottom:1px solid var(--b0);
    transition:background .14s;
}
.mov-item:last-child{border-bottom:none;}
.mov-item:hover{background:rgba(255,255,255,.02);}
.mov-icon{
    width:34px;height:34px;border-radius:9px;
    display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.mov-icon svg{width:14px;height:14px;}
.mov-info{flex:1;min-width:0;}
.mov-name{font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.mov-meta{font-size:11px;color:var(--t2);margin-top:2px;}
.mov-amount{font-family:var(--mono);font-size:13px;font-weight:600;white-space:nowrap;}
.mov-amount.pos{color:var(--green);}
.mov-amount.neg{color:var(--red);}

/* ── REPOSICIÓN ── */
.repo-item{
    padding:14px 22px;
    border-bottom:1px solid var(--b0);
    transition:background .14s;
}
.repo-item:last-child{border-bottom:none;}
.repo-item:hover{background:rgba(255,255,255,.02);}
.repo-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;}
.repo-name{font-size:13px;font-weight:600;}
.repo-code{font-family:var(--mono);font-size:10px;color:var(--t2);margin-top:2px;}
.repo-pill{
    font-size:10.5px;font-weight:700;
    padding:3px 9px;border-radius:6px;
    display:flex;align-items:center;gap:4px;white-space:nowrap;flex-shrink:0;
}
.repo-pill.red{background:var(--red-a);color:var(--red);}
.repo-pill.amber{background:var(--amber-a);color:var(--amber);}
.repo-pill svg{width:9px;height:9px;}
.repo-bar-wrap{height:3px;background:var(--s4);border-radius:2px;overflow:hidden;}
.repo-bar{height:3px;border-radius:2px;transition:width .6s ease;}
.repo-bar.red{background:var(--red);}
.repo-bar.amber{background:var(--amber);}
.repo-footer{display:flex;justify-content:space-between;align-items:center;margin-top:7px;}
.repo-cat{font-size:10.5px;color:var(--t2);}
.repo-min{font-size:10.5px;color:var(--t2);}

/* ── CHART STRIP ── */
.chart-strip{
    background: linear-gradient(145deg, rgba(255,255,255,0.02), rgba(255,255,255,0.005));
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border: 1px solid rgba(255,255,255,0.04);
    border-radius: 20px;
    padding: 24px 26px;
    margin-bottom: 24px;
    box-shadow: 
        inset 0 1px 0 rgba(255,255,255,0.08), 
        0 8px 32px rgba(0,0,0,0.15);
}
.chart-strip-head{
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:16px;
}
.chart-strip-title{font-size:13px;font-weight:700;letter-spacing:-.2px;}
.chart-strip-tabs{display:flex;gap:2px;background:var(--s2);border-radius:6px;padding:2px;}
.chart-tab{
    padding:4px 10px;border-radius:4px;font-size:11px;font-weight:600;
    color:var(--t2);cursor:pointer;transition:all .14s;
}
.chart-tab.active{background:var(--s4);color:var(--t0);}
.chart-area{height:80px;position:relative;}
canvas#mainChart{width:100%!important;}

/* ── ACTIVITY ROW ── */
.activity-row{
    display:grid;grid-template-columns:1fr 1fr;
    gap:20px;margin-bottom:24px;
}
.act-card{
    background: linear-gradient(145deg, rgba(255,255,255,0.02), rgba(255,255,255,0.005));
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border: 1px solid rgba(255,255,255,0.04);
    border-radius: 20px;
    padding: 24px 26px;
    box-shadow: 
        inset 0 1px 0 rgba(255,255,255,0.08), 
        0 8px 32px rgba(0,0,0,0.15);
}
.act-title{font-size:12px;font-weight:700;letter-spacing:-.1px;margin-bottom:14px;display:flex;align-items:center;gap:6px;}
.act-title .dot{width:6px;height:6px;border-radius:50%;}
.act-list{display:flex;flex-direction:column;gap:10px;}
.act-item{display:flex;align-items:center;justify-content:space-between;}
.act-name{font-size:12px;color:var(--t1);}
.act-val{font-size:12px;font-weight:600;font-family:var(--mono);}
.act-bar-row{display:flex;align-items:center;gap:8px;margin-top:4px;}
.act-bar-wrap{flex:1;height:3px;background:var(--s3);border-radius:2px;overflow:hidden;}
.act-bar{height:3px;border-radius:2px;}

/* ── SIDEBAR EXPANDED ── */
.sb{overflow-y:auto;overflow-x:hidden;}
.sb-logo-mark{
    background:var(--brand-a);
    box-shadow:none;
}
.sb-logo-text{font-size:15px;font-weight:800;letter-spacing:-.4px;}
.sb-logo-text small{font-size:10px;letter-spacing:.5px;text-transform:uppercase;opacity:.5;}

/* stats grid 2x3 */
.sb-stats{
    padding:12px 14px 10px;
    display:grid;grid-template-columns:1fr 1fr;gap:6px;
    border-bottom:1px solid var(--b0);
}
.sb-stat{
    background:var(--s2);border:1px solid var(--b0);
    border-radius:8px;padding:9px 10px;
    position:relative;overflow:hidden;transition:border-color .15s;
}
.sb-stat:hover{border-color:var(--b2);}
.sb-stat-v{font-size:18px;font-weight:800;letter-spacing:-.5px;font-family:var(--mono);line-height:1;}
.sb-stat-l{font-size:9.5px;color:var(--t2);margin-top:3px;font-weight:500;display:flex;align-items:center;gap:4px;}
.sb-stat-dot{width:5px;height:5px;border-radius:50%;flex-shrink:0;}

/* quick actions */
.sb-actions{padding:10px 14px;border-bottom:1px solid var(--b0);}
.sb-actions-title{font-size:9.5px;letter-spacing:1.2px;text-transform:uppercase;color:var(--t2);font-weight:600;padding:2px 0 6px;}
.sb-actions-grid{display:flex;flex-direction:column;gap:3px;}
.sb-action{
    display:flex;align-items:center;gap:8px;
    padding:7px 9px;border-radius:7px;
    font-size:12px;font-weight:600;color:var(--t1);
    cursor:pointer;transition:all .14s;
    border:1px solid transparent;width:100%;text-align:left;
}
.sb-action svg{width:14px;height:14px;flex-shrink:0;}
.sb-action:hover{color:var(--t0);background:var(--b0);border-color:var(--b0);}
.sb-action .act-icon{
    width:26px;height:26px;border-radius:6px;
    display:flex;align-items:center;justify-content:center;flex-shrink:0;
}

/* activity feed */
.sb-feed{padding:10px 14px;border-bottom:1px solid var(--b0);}
.sb-feed-title{font-size:9.5px;letter-spacing:1.2px;text-transform:uppercase;color:var(--t2);font-weight:600;padding:2px 0 8px;}
.sb-feed-list{display:flex;flex-direction:column;gap:2px;max-height:160px;overflow-y:auto;}
.sb-feed-item{
    display:flex;align-items:flex-start;gap:8px;
    padding:6px 8px;border-radius:6px;transition:background .14s;
}
.sb-feed-item:hover{background:var(--b0);}
.sb-feed-dot{
    width:6px;height:6px;border-radius:50%;flex-shrink:0;margin-top:5px;
}
.sb-feed-text{font-size:11.5px;color:var(--t1);line-height:1.35;}
.sb-feed-time{font-size:10px;color:var(--t2);font-family:var(--mono);margin-top:1px;}
.sb-feed-empty{font-size:11px;color:var(--t2);padding:8px;text-align:center;}

/* featured products */
.sb-featured{padding:10px 14px;border-bottom:1px solid var(--b0);}
.sb-featured-title{font-size:9.5px;letter-spacing:1.2px;text-transform:uppercase;color:var(--t2);font-weight:600;padding:2px 0 8px;}
.sb-featured-list{display:flex;flex-direction:column;gap:2px;}
.sb-featured-item{
    display:flex;align-items:center;justify-content:space-between;
    padding:6px 8px;border-radius:6px;transition:background .14s;cursor:pointer;
}
.sb-featured-item:hover{background:var(--b0);}
.sb-featured-name{font-size:12px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px;}
.sb-featured-price{font-size:11px;font-weight:700;font-family:var(--mono);color:var(--green);}
.sb-featured-stock{font-size:10px;color:var(--t2);margin-top:1px;}

/* alert banner */
.sb-alert{
    margin:10px 14px;padding:10px 12px;
    background:var(--red-a);
    border:1px solid rgba(240,52,26,0.2);
    border-radius:8px;
    display:flex;align-items:flex-start;gap:8px;
    animation:alertPulse 3s ease-in-out infinite;
}
.sb-alert svg{width:14px;height:14px;flex-shrink:0;color:var(--red);margin-top:1px;}
.sb-alert-text{font-size:11.5px;color:var(--t0);line-height:1.3;}
.sb-alert-text strong{color:var(--red);font-weight:700;}
.sb-alert-text a{color:var(--red);text-decoration:underline;font-weight:600;}
@keyframes alertPulse{0%,100%{opacity:1;}50%{opacity:.75;}}

/* modal */
.sb-modal-overlay{
    position:fixed;inset:0;background:rgba(0,0,0,0.6);
    z-index:200;display:none;align-items:center;justify-content:center;
    backdrop-filter:blur(4px);
}
.sb-modal-overlay.show{display:flex;}
.sb-modal{
    background:var(--s1);border:1px solid var(--b1);
    border-radius:14px;width:420px;max-width:90vw;
    padding:28px;position:relative;
}
.sb-modal h3{font-size:16px;font-weight:800;margin-bottom:18px;letter-spacing:-.3px;}
.sb-modal-close{
    position:absolute;top:14px;right:14px;
    width:28px;height:28px;border-radius:6px;
    display:flex;align-items:center;justify-content:center;
    color:var(--t2);cursor:pointer;transition:all .14s;
}
.sb-modal-close:hover{background:var(--s3);color:var(--t0);}
.sb-modal-close svg{width:14px;height:14px;}
.sb-field{margin-bottom:12px;}
.sb-field label{display:block;font-size:11px;font-weight:600;color:var(--t2);margin-bottom:4px;text-transform:uppercase;letter-spacing:.5px;}
.sb-field input,.sb-field select{
    width:100%;padding:9px 12px;
    background:var(--s2);border:1px solid var(--b1);
    border-radius:7px;color:var(--t0);font-size:13px;
    transition:border-color .14s;outline:none;
}
.sb-field input:focus,.sb-field select:focus{border-color:var(--red);}
.sb-field-row{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.sb-modal-btn{
    width:100%;padding:11px;margin-top:6px;
    background:var(--red);color:#fff;border-radius:8px;
    font-size:13px;font-weight:700;cursor:pointer;
    transition:all .15s;border:none;
}
.sb-modal-btn:hover{background:var(--red2);}
.sb-modal-msg{
    padding:8px 12px;border-radius:6px;margin-top:10px;
    font-size:12px;font-weight:600;display:none;
}
.sb-modal-msg.success{display:block;background:var(--green-a);color:var(--green);}
.sb-modal-msg.error{display:block;background:var(--red-a);color:var(--red);}

/* ── NOISE TEXTURE ── */
.app::after{
    content:'';
    position:fixed;inset:0;pointer-events:none;z-index:100;
    opacity:.025;
    background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
}
</style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="app()" x-init="init()">
<div class="app">

<!-- ══ SIDEBAR ══ -->
<aside class="sb">
    <div class="px-7 py-8 flex items-center gap-3.5 border-b border-white/[0.02]">
        <div class="w-[42px] h-[42px] rounded-[14px] bg-gradient-to-br from-white/10 to-white/[0.02] border border-white/10 flex items-center justify-center shadow-[0_4_20px_rgba(0,0,0,0.2)] backdrop-blur-md shrink-0">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke-opacity="0.15"/>
                <path d="M12 2a10 10 0 0110 10" stroke-linecap="round"/>
                <circle cx="12" cy="12" r="3" stroke-opacity="0.4"/>
                <path d="M12 12l4-4" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="flex flex-col">
            <div class="text-[17.5px] font-extrabold tracking-tight text-white leading-none mb-1.5">
                AutoCars <span class="text-white/40 font-semibold">Cabrera</span>
            </div>
            <div class="text-[8.5px] font-mono tracking-[0.25em] text-[var(--brand)] uppercase font-bold opacity-90">
                Sistema POS <span class="text-white/30">— v3</span>
            </div>
        </div>
    </div>

    <!-- STATS SUMMARY -->
    <div class="px-5 pb-5 mt-2">
      <div class="grid grid-cols-2 gap-3">
        
        <div class="bg-[var(--s2)] border border-[var(--b0)] rounded-[14px] p-3 shadow-sm flex flex-col justify-between hover:bg-[var(--s3)] hover:border-[var(--b1)] transition-all duration-200 group cursor-default">
            <div class="text-[9.5px] uppercase font-bold text-[var(--t2)] tracking-widest group-hover:text-white/60 transition-colors">Ventas hoy</div>
            <div class="text-[16px] font-bold text-[var(--t0)] mt-1.5 font-mono tracking-tight leading-none">S/{{ number_format($ventasHoy ?? 0, 0) }}</div>
        </div>

        <div class="bg-[var(--s2)] border border-[var(--b0)] rounded-[14px] p-3 shadow-sm flex flex-col justify-between hover:bg-[var(--s3)] hover:border-[var(--b1)] transition-all duration-200 group cursor-default">
            <div class="text-[9.5px] uppercase font-bold text-[var(--t2)] tracking-widest group-hover:text-white/60 transition-colors">Productos</div>
            <div class="text-[16px] font-bold text-[var(--t0)] mt-1.5 font-mono tracking-tight leading-none">{{ $totalProductos ?? 0 }}</div>
        </div>

        <div class="bg-[var(--s2)] border border-[var(--b0)] rounded-[14px] p-3 shadow-sm flex flex-col justify-between hover:bg-[var(--s3)] hover:border-[var(--b1)] transition-all duration-200 group cursor-default">
            <div class="text-[9.5px] uppercase font-bold text-[var(--t2)] tracking-widest group-hover:text-white/60 transition-colors">Stock bajo</div>
            <div class="text-[16px] font-bold text-[var(--t0)] mt-1.5 font-mono tracking-tight leading-none">{{ $stockBajo ?? 0 }}</div>
        </div>

        <div class="bg-[var(--s2)] border border-[var(--b0)] rounded-[14px] p-3 shadow-sm flex flex-col justify-between hover:bg-[var(--s3)] hover:border-[var(--b1)] transition-all duration-200 group cursor-default">
            <div class="text-[9.5px] uppercase font-bold text-[var(--t2)] tracking-widest group-hover:text-[var(--red)] transition-colors">Críticos</div>
            <div class="text-[16px] font-bold text-[var(--t0)] mt-1.5 font-mono tracking-tight leading-none">{{ $stockCritico ?? 0 }}</div>
        </div>

        <div class="bg-[var(--s2)] border border-[var(--b0)] rounded-[14px] p-3 shadow-sm flex flex-col justify-between hover:bg-[var(--s3)] hover:border-[var(--b1)] transition-all duration-200 group cursor-default">
            <div class="text-[9.5px] uppercase font-bold text-[var(--t2)] tracking-widest group-hover:text-white/60 transition-colors">Clientes</div>
            <div class="text-[16px] font-bold text-[var(--t0)] mt-1.5 font-mono tracking-tight leading-none">{{ $totalClientes ?? 0 }}</div>
        </div>

        <div class="bg-[var(--s2)] border border-[var(--b0)] rounded-[14px] p-3 shadow-sm flex flex-col justify-between hover:bg-[var(--s3)] hover:border-[var(--b1)] transition-all duration-200 group cursor-default">
            <div class="text-[9.5px] uppercase font-bold text-[var(--t2)] tracking-widest group-hover:text-white/60 transition-colors">Movimientos</div>
            <div class="text-[16px] font-bold text-[var(--t0)] mt-1.5 font-mono tracking-tight leading-none">{{ $ventasHoyCount ?? 0 }}</div>
        </div>

      </div>
    </div>

    <!-- ALERT BANNER -->
    @if(($stockCritico ?? 0) > 0)
    <div class="sb-alert">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        <div class="sb-alert-text">
            <strong>{{ $stockCritico }} producto{{ $stockCritico > 1 ? 's' : '' }}</strong> con stock crítico.
            <a href="#" @click.prevent="page='inventario'">Revisar inventario</a>
        </div>
    </div>
    @endif

    <!-- NAV -->
    <div class="sb-nav">
        <div class="nav-section">
            <div class="nav-sec-lbl">Navegación</div>
            <button @click="page='panel'" class="nav-item" :class="page==='panel'?'active':''">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                Panel
            </button>
            <button @click="page='clientes'" class="nav-item" :class="page==='clientes'?'active':''">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Directorio
            </button>
            <button @click="page='inventario'" class="nav-item" :class="page==='inventario'?'active':''">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                Inventario
            </button>
                <!-- @if(($stockCritico ?? 0) > 0)<span class="nav-badge">{{ $stockCritico }}</span>@endif -->
            <button @click="page='pos'" class="nav-item" :class="page==='pos'?'active':''">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                Punto de Venta
            </button>
        </div>
    </div>

    <!-- QUICK ACTIONS -->
    <div class="sb-actions">
        <div class="sb-actions-title">Acciones rápidas</div>
        <div class="sb-actions-grid">
            <button class="sb-action" onclick="openModal('modalProducto')">
                <span class="act-icon" style="background:var(--green-a);color:var(--green)"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                Nuevo producto
            </button>
            <button class="sb-action" onclick="openModal('modalStock')">
                <span class="act-icon" style="background:var(--blue-a);color:var(--blue)"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg></span>
                Agregar stock
            </button>
            <button @click="page='pos'" class="sb-action">
                <span class="act-icon" style="background:var(--brand-a);color:var(--brand)"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg></span>
                Nueva venta
            </button>
        </div>
    </div>

    <!-- ACTIVITY FEED -->
    <div class="sb-feed">
        <div class="sb-feed-title">Actividad reciente</div>
        <div class="sb-feed-list">
            @forelse(($movimientos ?? collect())->take(5) as $m)
            <div class="sb-feed-item">
                <span class="sb-feed-dot" style="background:{{ $m->tipo === 'ingreso' ? 'var(--green)' : 'var(--red)' }}"></span>
                <div>
                    <div class="sb-feed-text">{{ $m->concepto ?? 'Movimiento registrado' }}</div>
                    <div class="sb-feed-time">S/{{ number_format($m->monto, 2) }} · {{ $m->created_at?->diffForHumans() ?? '' }}</div>
                </div>
            </div>
            @empty
            <div class="sb-feed-empty">Sin actividad reciente</div>
            @endforelse
        </div>
    </div>

    <!-- FEATURED PRODUCTS -->
    @if(($productosDestacados ?? collect())->count() > 0)
    <div class="sb-featured">
        <div class="sb-featured-title">Productos destacados</div>
        <div class="sb-featured-list">
            @foreach(($productosDestacados ?? collect())->take(5) as $pd)
            <a href="{{ route('inventario.index') }}" class="sb-featured-item">
                <div>
                    <div class="sb-featured-name">{{ $pd->nombre }}</div>
                    <div class="sb-featured-stock">Stock: {{ $pd->stock }} · {{ $pd->categoria ?? '' }}</div>
                </div>
                <div class="sb-featured-price">S/{{ number_format($pd->precio1, 0) }}</div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- USER -->
    <div class="sb-bottom" style="margin-top:auto;">
        <div class="user-row">
            <div class="user-av">EC</div>
            <div>
                <div class="user-name">Estrella Cabrera L.</div>
                <div class="user-role">Gestor del sistema</div>
            </div>
        </div>
    </div>
</aside>

<!-- MODAL: Nuevo Producto -->
<div class="sb-modal-overlay" id="modalProducto">
    <div class="sb-modal">
        <button class="sb-modal-close" onclick="closeModal('modalProducto')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        <h3>Nuevo Producto</h3>
        <form id="formProducto" onsubmit="return saveProducto(event)">
            <div class="sb-field"><label>Nombre</label><input type="text" name="nombre" required></div>
            <div class="sb-field-row">
                <div class="sb-field"><label>Código</label><input type="text" name="codigo"></div>
                <div class="sb-field"><label>Categoría</label><input type="text" name="categoria"></div>
            </div>
            <div class="sb-field-row">
                <div class="sb-field"><label>Precio</label><input type="number" step="0.01" name="precio1" required></div>
                <div class="sb-field"><label>Stock</label><input type="number" name="stock" required></div>
            </div>
            <div class="sb-field-row">
                <div class="sb-field"><label>Stock Mín</label><input type="number" name="stockMin" value="5"></div>
                <div class="sb-field"><label>Marca</label><input type="text" name="marca"></div>
            </div>
            <button type="submit" class="sb-modal-btn">Guardar producto</button>
            <div class="sb-modal-msg" id="msgProducto"></div>
        </form>
    </div>
</div>

<!-- MODAL: Agregar Stock -->
<div class="sb-modal-overlay" id="modalStock">
    <div class="sb-modal">
        <button class="sb-modal-close" onclick="closeModal('modalStock')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        <h3>Agregar Stock</h3>
        <form id="formStock" onsubmit="return addStock(event)">
            <div class="sb-field">
                <label>Producto</label>
                <select name="producto_id" id="stockProductoSelect" required>
                    <option value="">Seleccionar producto...</option>
                </select>
            </div>
            <div class="sb-field"><label>Cantidad a agregar</label><input type="number" name="cantidad" min="1" required></div>
            <button type="submit" class="sb-modal-btn">Actualizar stock</button>
            <div class="sb-modal-msg" id="msgStock"></div>
        </form>
    </div>
</div>

<!-- ══ MAIN ══ -->
<div class="main">

    <!-- TOPBAR -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="topbar-title" x-text="{'panel':'Panel de Control','clientes':'Directorio de Clientes','inventario':'Inventario','pos':'Terminal TPV','caja':'Caja'}[page]||page"></div>
            <div class="topbar-sub">Visión general · {{ now()->isoFormat('dddd, D [de] MMMM') ?? 'jueves, 19 de marzo' }}</div>
        </div>
        <div class="topbar-right">
            <div class="topbar-date">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                {{ now()->format('H:i') ?? '09:00' }}
            </div>
            <button class="topbar-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                <span class="notif-dot"></span>
            </button>
            <button @click="page='pos'" class="btn-tpv">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                Nueva Venta
            </button>
        </div>
    </header>

    <!-- CONTENT -->
    <div class="content">

        <div x-show="page==='panel'">
<!-- KPI GRID -->
        <div class="kpi-grid">

            <div class="kpi k-green">
                <div class="kpi-bg">0</div>
                <div class="kpi-top">
                    <div class="kpi-label">Ingresos hoy</div>
                    <div class="kpi-icon green">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                </div>
                <div class="kpi-value">S/ 0.00</div>
                <div class="kpi-footer">
                    <span class="kpi-badge green">— 0 transacciones</span>
                </div>
                <svg class="kpi-spark" viewBox="0 0 200 36" preserveAspectRatio="none">
                    <polyline fill="none" stroke="var(--green)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" points="0,28 40,24 80,20 120,22 160,16 200,18"/>
                </svg>
            </div>

            <div class="kpi k-blue">
                <div class="kpi-bg">0</div>
                <div class="kpi-top">
                    <div class="kpi-label">Saldo en caja</div>
                    <div class="kpi-icon blue">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                    </div>
                </div>
                <div class="kpi-value">S/ 0.00</div>
                <div class="kpi-footer">
                    <span class="kpi-sub">Ingresos − egresos</span>
                </div>
                <svg class="kpi-spark" viewBox="0 0 200 36" preserveAspectRatio="none">
                    <polyline fill="none" stroke="var(--blue)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" points="0,18 50,16 100,18 150,16 200,18"/>
                </svg>
            </div>

            <div class="kpi k-amber">
                <div class="kpi-bg">{{ $totalClientes ?? 3 }}</div>
                <div class="kpi-top">
                    <div class="kpi-label">Clientes</div>
                    <div class="kpi-icon amber">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    </div>
                </div>
                <div class="kpi-value">{{ $totalClientes ?? 3 }}</div>
                <div class="kpi-footer">
                    <span class="kpi-badge amber">— Registros activos</span>
                </div>
                <svg class="kpi-spark" viewBox="0 0 200 36" preserveAspectRatio="none">
                    <polyline fill="none" stroke="var(--amber)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" points="0,22 60,20 100,18 140,22 180,19 200,20"/>
                </svg>
            </div>

            <div class="kpi k-red">
                <div class="kpi-bg">{{ $stockCritico ?? 2 }}</div>
                <div class="kpi-top">
                    <div class="kpi-label">Stock crítico</div>
                    <div class="kpi-icon red">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                </div>
                <div class="kpi-value" style="color:var(--red)">{{ $stockCritico ?? 2 }}</div>
                <div class="kpi-footer">
                    <span class="kpi-badge red">— Bajo mínimo</span>
                </div>
                <svg class="kpi-spark" viewBox="0 0 200 36" preserveAspectRatio="none">
                    <polyline fill="none" stroke="var(--red)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" points="0,10 50,14 100,12 150,16 200,12"/>
                </svg>
            </div>

        </div><!-- /kpi-grid -->

        <!-- CHART STRIP -->
        <div class="chart-strip">
            <div class="chart-strip-head">
                <div class="chart-strip-title">Actividad de ventas</div>
                <div class="chart-strip-tabs">
                    <div class="chart-tab active" onclick="setChartTab(this,'hoy')">Hoy</div>
                    <div class="chart-tab" onclick="setChartTab(this,'sem')">Semana</div>
                    <div class="chart-tab" onclick="setChartTab(this,'mes')">Mes</div>
                </div>
            </div>
            <div class="chart-area">
                <canvas id="mainChart" height="80"></canvas>
            </div>
        </div>

        <!-- ACTIVITY ROW -->
        <div class="activity-row">
            <div class="act-card flex flex-col justify-between">
                <div class="uppercase tracking-widest text-[var(--t2)] text-[10px] font-bold mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--t2)] opacity-30"></span>
                    Top categorías
                </div>
                <div class="flex flex-col gap-4">
                    @php
                    $cats = $categoriaStats ?? [
                        ['nombre'=>'Lubricantes','pct'=>35],
                        ['nombre'=>'Frenos','pct'=>22],
                        ['nombre'=>'Accesorios','pct'=>18],
                        ['nombre'=>'Filtros','pct'=>15],
                        ['nombre'=>'Transmisión','pct'=>10],
                    ];
                    @endphp
                    @foreach($cats as $cat)
                    <div class="group cursor-default">
                        <div class="flex justify-between items-center text-xs mb-2">
                            <span class="text-[var(--t1)] group-hover:text-white transition-colors">{{ $cat['nombre'] }}</span>
                            <span class="font-mono font-semibold text-white/40 group-hover:text-white transition-colors">{{ $cat['pct'] }}%</span>
                        </div>
                        <div class="w-full bg-[var(--b0)] h-[2px] rounded-full overflow-hidden">
                            <div class="bg-white/20 h-[2px] rounded-full group-hover:bg-white transition-colors" style="width:{{ $cat['pct'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="act-card flex flex-col">
                <div class="uppercase tracking-widest text-[var(--t2)] text-[10px] font-bold mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--t2)] opacity-30"></span>
                    Resumen del día
                </div>
                <div class="mt-1 flex flex-col gap-4">
                    <div class="flex justify-between items-center px-2 py-1 -mx-2 rounded hover:bg-white/[0.02] transition-colors group cursor-default">
                        <span class="text-[11.5px] text-[var(--t1)] group-hover:text-white transition-colors">Ventas realizadas</span>
                        <span class="font-mono text-[13px] font-bold text-[var(--t0)]">{{ $ventasHoyCount ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center px-2 py-1 -mx-2 rounded hover:bg-white/[0.02] transition-colors group cursor-default">
                        <span class="text-[11.5px] text-[var(--t1)] group-hover:text-white transition-colors">Productos vendidos</span>
                        <span class="font-mono text-[13px] font-bold text-[var(--t0)]">{{ $productosVendidosHoy ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center px-2 py-1 -mx-2 rounded hover:bg-white/[0.02] transition-colors group cursor-default">
                        <span class="text-[11.5px] text-[var(--t1)] group-hover:text-white transition-colors">Ticket promedio</span>
                        <span class="font-mono text-[13px] font-bold text-[var(--t0)]">S/ 0.00</span>
                    </div>
                    <div class="flex justify-between items-center px-2 py-1 -mx-2 rounded hover:bg-white/[0.02] transition-colors group cursor-default">
                        <span class="text-[11.5px] text-[var(--t1)] group-hover:text-white transition-colors">Nuevos clientes</span>
                        <span class="font-mono text-[13px] font-bold text-[var(--t0)]">0</span>
                    </div>
                    <div class="flex justify-between items-center px-2 py-1 -mx-2 rounded hover:bg-white/[0.02] transition-colors group cursor-default">
                        <span class="text-[11.5px] text-[var(--t1)] group-hover:text-[var(--red)] transition-colors">Alertas de stock</span>
                        <span class="font-mono text-[13px] font-bold text-[var(--t0)] group-hover:text-[var(--red)] transition-colors">{{ $stockCritico ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTTOM GRID -->
        <div class="bottom-grid">

            <!-- ÚLTIMOS MOVIMIENTOS -->
            <div class="card">
                <div class="card-head">
                    <div class="card-title">Últimos movimientos</div>
                    <a href="#" class="card-link">
                        Ver todos
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>

                @if(($movimientos ?? collect())->isEmpty())
                <div class="mov-empty">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <p>No hay transacciones registradas hoy</p>
                </div>
                @else
                @foreach($movimientos->take(6) as $mov)
                <div class="mov-item">
                    <div class="mov-icon" style="background:{{ $mov->tipo === 'venta' ? 'var(--green-a)' : 'var(--red-a)' }};color:{{ $mov->tipo === 'venta' ? 'var(--green)' : 'var(--red)' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="{{ $mov->tipo === 'venta' ? '23 6 13.5 15.5 8.5 10.5 1 18' : '23 18 13.5 8.5 8.5 13.5 1 6' }}"/></svg>
                    </div>
                    <div class="mov-info">
                        <div class="mov-name">{{ $mov->descripcion ?? 'Movimiento' }}</div>
                        <div class="mov-meta">{{ $mov->created_at?->format('H:i') }} · {{ $mov->tipo }}</div>
                    </div>
                    <div class="mov-amount {{ $mov->tipo === 'venta' ? 'pos' : 'neg' }}">
                        {{ $mov->tipo === 'venta' ? '+' : '-' }}S/ {{ number_format($mov->monto, 2) }}
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <!-- REPOSICIÓN URGENTE -->
            <div class="card bg-[var(--s2)] border border-[var(--b0)] rounded-[20px] overflow-hidden shadow-sm flex flex-col">
                <div class="flex items-center justify-between px-6 py-5 border-b border-[var(--b0)]">
                    <div class="uppercase tracking-widest text-[var(--t2)] text-[10px] font-bold flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--t2)] opacity-30"></span>
                        Reposición urgente
                    </div>
                    <a href="{{ route('inventario.index') ?? '#' }}" class="text-[11px] text-[var(--t2)] hover:text-white transition-colors flex items-center gap-1 font-semibold">
                        Ver inventario
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>

                <div class="divide-y divide-[var(--b0)] flex-1 overflow-y-auto max-h-[300px]">
                @forelse($productosReposicion ?? [] as $p)
                @php
                    $pct = $p->stock_minimo > 0 ? min(100, round($p->stock / $p->stock_minimo * 100)) : 0;
                @endphp
                <div class="group px-6 py-4 hover:bg-[var(--s3)] transition-colors flex flex-col gap-3 cursor-default">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-[13px] font-semibold text-[var(--t0)] group-hover:text-white transition-colors">{{ $p->nombre }}</div>
                            <div class="text-[10px] font-mono text-[var(--t2)] mt-1">{{ $p->codigo ?? 'Sin código' }} · {{ $p->categoria }}</div>
                        </div>
                        <span class="px-2.5 py-1 text-[10px] font-mono font-bold border border-[var(--b2)] text-[var(--t1)] rounded-md opacity-70 group-hover:opacity-100 group-hover:border-[var(--red-a)] group-hover:text-[var(--red)] transition-all flex items-center gap-1.5 whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--red)] opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            {{ $p->stock }} {{ $p->unidad_medida ?? 'und' }}
                        </span>
                    </div>
                    <div class="w-full bg-[var(--b0)] h-[2px] rounded-full overflow-hidden">
                        <div class="bg-white/20 h-[2px] rounded-full group-hover:bg-[var(--red)] transition-colors" style="width:{{ $pct }}%"></div>
                    </div>
                </div>
                @empty
                {{-- fallback con datos reales de la imagen --}}
                <div class="group px-6 py-4 hover:bg-[var(--s3)] transition-colors flex flex-col gap-3 cursor-default">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-[13px] font-semibold text-[var(--t0)] group-hover:text-white transition-colors">Faro Delantero LED Ojo de Ángel 7 Pulgadas</div>
                            <div class="text-[10px] font-mono text-[var(--t2)] mt-1">ACC-101 · Accesorios</div>
                        </div>
                        <span class="px-2.5 py-1 text-[10px] font-mono font-bold border border-[var(--b2)] text-[var(--t1)] rounded-md opacity-70 group-hover:opacity-100 group-hover:border-[var(--red-a)] group-hover:text-[var(--red)] transition-all flex items-center gap-1.5 whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--red)] opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            1 und
                        </span>
                    </div>
                    <div class="w-full bg-[var(--b0)] h-[2px] rounded-full overflow-hidden">
                        <div class="bg-white/20 h-[2px] rounded-full group-hover:bg-[var(--red)] transition-colors" style="width:10%"></div>
                    </div>
                </div>
                <div class="group px-6 py-4 hover:bg-[var(--s3)] transition-colors flex flex-col gap-3 cursor-default">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-[13px] font-semibold text-[var(--t0)] group-hover:text-white transition-colors">Kit de Arrastre Racing (Cadena+Piñón+Corona)</div>
                            <div class="text-[10px] font-mono text-[var(--t2)] mt-1">TRA-005 · Transmisión</div>
                        </div>
                        <span class="px-2.5 py-1 text-[10px] font-mono font-bold border border-[var(--b2)] text-[var(--t1)] rounded-md opacity-70 group-hover:opacity-100 group-hover:border-[var(--red-a)] group-hover:text-[var(--red)] transition-all flex items-center gap-1.5 whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--red)] opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            2 kit
                        </span>
                    </div>
                    <div class="w-full bg-[var(--b0)] h-[2px] rounded-full overflow-hidden">
                        <div class="bg-white/20 h-[2px] rounded-full group-hover:bg-[var(--red)] transition-colors" style="width:25%"></div>
                    </div>
                </div>
                @endforelse
                </div>
            </div>

        </div><!-- /bottom-grid -->
</div><!-- /x-show panel -->

<!-- ===== CLIENTES ===== -->
      <div x-show="page==='clientes'" class="space-y-6" style="display:none; padding: 0 10px;">
        <div class="flex items-center justify-between bg-[var(--s1)] p-5 border border-[var(--b0)] rounded-2xl shadow-sm">
          <div class="relative w-96">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input x-model="busqCliente" placeholder="Buscar por nombre, RUC..." class="w-full pl-11 py-2.5 bg-[var(--s2)] border border-[var(--b1)] rounded-xl text-white placeholder-white/40 focus:outline-none focus:border-[var(--brand)] transition-colors text-sm">
          </div>
          <button class="btn-primary py-2.5 px-6 rounded-xl font-bold shadow-lg" @click="modalCliente=true;editCliente=null;formC={razon:'',comercial:'',tipoDoc:'RUC',nroDoc:'',telefono:'',email:'',direccion:'',distrito:'',ciudad:'Lima',credDias:0,limCredito:0,listaPrecio:'1',estado:'activo',notas:''}">
            + Nuevo Cliente
          </button>
        </div>
        <div class="bg-[var(--s1)] border border-[var(--b0)] rounded-2xl overflow-hidden shadow-2xl">
          <div x-show="clientesFiltrados().length===0" class="text-center py-16 text-white/40 text-sm">Ningún cliente encontrado. Intenta buscar otro nombre.</div>
          <table x-show="clientesFiltrados().length>0" class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-[var(--s2)] border-b border-[var(--b0)]">
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50">Doc</th>
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50">Razón Social</th>
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50">Teléfono</th>
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50">Estado</th>
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50 text-right">Acciones</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[var(--b0)]">
              <template x-for="c in clientesFiltrados()" :key="c.id">
                <tr class="hover:bg-white/[0.02] transition-colors group cursor-default">
                  <td class="px-6 py-4 whitespace-nowrap"><span class="badge bg-[var(--s2)] border-[var(--b1)] text-white/60 text-[10px] px-2.5" x-text="c.tipoDoc+' '+c.nroDoc"></span></td>
                  <td class="px-6 py-4 text-sm font-bold text-white group-hover:text-[var(--brand)] transition-colors" x-text="c.razon"></td>
                  <td class="px-6 py-4 text-sm text-white/60" x-text="c.telefono||'--'"></td>
                  <td class="px-6 py-4 whitespace-nowrap"><span class="badge px-2.5" :class="c.estado==='activo'?'badge-ok':'badge-low'" x-text="c.estado"></span></td>
                  <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                    <button @click="abrirEditCliente(c)" class="text-white/40 hover:text-[var(--brand)] p-2 bg-[var(--s2)] rounded hover:bg-[var(--brand-a)] transition-all" title="Editar"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                    <button @click="eliminarCliente(c.id)" class="text-white/40 hover:text-[var(--red)] p-2 bg-[var(--s2)] rounded hover:bg-[var(--red-a)] transition-all" title="Eliminar"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>

      
<!-- ===== INVENTARIO ===== -->
      <div x-show="page==='inventario'" class="space-y-6" style="display:none; padding: 0 10px;">
        <div class="flex items-center justify-between bg-[var(--s1)] p-5 border border-[var(--b0)] rounded-2xl shadow-sm">
          <div class="relative w-96">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input x-model="busqInv" placeholder="Buscar por código o nombre..." class="w-full pl-11 py-2.5 bg-[var(--s2)] border border-[var(--b1)] rounded-xl text-white placeholder-white/40 focus:outline-none focus:border-[var(--brand)] transition-colors text-sm">
          </div>
          <button class="btn-primary py-2.5 px-6 rounded-xl font-bold shadow-lg" @click="formI={codigo:'',nombre:'',categoria:'Lubricantes',marca:'',unidad:'Unidad',precio1:'',precio2:'',precio3:'',stock:0,stockMin:0,stockMax:0,ubicacion:'',estado:'activo'};editInv=null;modalInv=true">
            + Nuevo Producto
          </button>
        </div>
        <div class="bg-[var(--s1)] border border-[var(--b0)] rounded-2xl overflow-hidden shadow-2xl">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-[var(--s2)] border-b border-[var(--b0)]">
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50">Código</th>
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50">Producto</th>
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50">Categoría</th>
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50">Precio Público</th>
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50">Stock</th>
                <th class="px-6 py-4 font-semibold text-xs tracking-wider uppercase text-white/50 text-right">Acciones</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[var(--b0)]">
              <template x-for="p in invFiltrado()" :key="p.id">
                <tr class="hover:bg-white/[0.02] transition-colors group cursor-default">
                  <td class="px-6 py-4 whitespace-nowrap"><span class="badge bg-[var(--s2)] border-[var(--b1)] text-white/60 text-[10px] px-2.5" x-text="p.codigo"></span></td>
                  <td class="px-6 py-4 text-sm font-bold text-white truncate max-w-xs group-hover:text-[var(--brand)] transition-colors" x-text="p.nombre"></td>
                  <td class="px-6 py-4 text-sm text-white/60" x-text="p.categoria"></td>
                  <td class="px-6 py-4 text-sm font-display font-bold text-white" x-text="'S/ '+parseFloat(p.precio1).toFixed(2)"></td>
                  <td class="px-6 py-4 whitespace-nowrap"><span class="badge text-[10px] px-2.5" :class="p.stock<=0?'badge-low':p.stock<=p.stockMin?'badge-warn':'badge-ok'" x-text="p.stock+' '+p.unidad"></span></td>
                  <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                    <button @click="abrirEditInv(p)" class="text-white/40 hover:text-[var(--brand)] p-2 bg-[var(--s2)] rounded hover:bg-[var(--brand-a)] transition-all" title="Editar"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                    <button @click="eliminarProd(p.id)" class="text-white/40 hover:text-[var(--red)] p-2 bg-[var(--s2)] rounded hover:bg-[var(--red-a)] transition-all" title="Eliminar"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
          <div x-show="invFiltrado().length===0" class="text-center py-12 text-muted">No se encontraron productos.</div>
        </div>
      </div>

      
      <!-- ===== PUNTO DE VENTA (POS) ===== -->
      <div x-show="page==='pos'" class="flex gap-5 overflow-hidden" style="display:none; height: calc(100vh - 140px); padding: 0 10px;">
        <!-- Product Catalog -->
        <div class="flex-1 flex flex-col bg-[var(--s1)] rounded-2xl border border-[var(--b0)] overflow-hidden shadow-sm">
          <div class="p-5 border-b border-[var(--b0)]">
            <div class="relative w-full mb-4">
              <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
              <input x-model="posBusq" type="text" placeholder="Buscar producto por código o nombre..." class="w-full pl-11 py-3 bg-[var(--s2)] border border-[var(--b1)] rounded-xl text-white placeholder-white/40 focus:outline-none focus:border-[var(--brand)] transition-colors text-sm shadow-inner" @keydown.enter.prevent="agregarPorBusqueda()">
            </div>
            <div class="flex gap-2 overflow-x-auto pb-2" style="scrollbar-width:none;">
              <button class="px-5 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest whitespace-nowrap cursor-pointer transition-all border" :class="posCategoria===''?'bg-[var(--brand)] text-[var(--b0)] border-transparent shadow-[0_0_15px_var(--brand-a)]':'bg-[var(--s2)] border-[var(--b1)] text-white/50 hover:bg-[var(--s3)] hover:text-white'" @click="posCategoria=''">Todos</button>
              <template x-for="cat in [...new Set(inventario.map(i=>i.categoria).filter(Boolean))]">
                <button class="px-5 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest whitespace-nowrap cursor-pointer transition-all border" @click="posCategoria=cat" :class="posCategoria===cat?'bg-[var(--brand)] text-[var(--b0)] border-transparent shadow-[0_0_15px_var(--brand-a)]':'bg-[var(--s2)] border-[var(--b1)] text-white/50 hover:bg-[var(--s3)] hover:text-white'" x-text="cat"></button>
              </template>
            </div>
          </div>
          <div class="flex-1 overflow-y-auto p-5">
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
              <template x-for="p in inventario.filter(i=>(!posCategoria||i.categoria===posCategoria)&&(i.nombre.toLowerCase().includes(posBusq.toLowerCase())||i.codigo.toLowerCase().includes(posBusq.toLowerCase())))">
                <div class="bg-[var(--s2)] border border-[var(--b0)] rounded-[14px] p-4 cursor-pointer hover:bg-[var(--s3)] hover:border-[var(--brand-a)] hover:shadow-lg transition-all flex flex-col relative group" @click="agregarAlCarrito(p)">
                  <div class="absolute top-3 right-3"><span class="px-2 py-0.5 rounded text-[9px] font-bold border" :class="p.stock<=0?'bg-[var(--red-a)] text-[var(--red)] border-[var(--red)]/20':p.stock<=p.stockMin?'bg-[var(--amber-a)] text-[var(--amber)] border-[var(--amber)]/20':'bg-white/5 text-white/50 border-white/10'" x-text="p.stock+' ud'"></span></div>
                  <div class="w-12 h-12 bg-[var(--s1)] rounded-xl border border-[var(--b1)] flex items-center justify-center text-white/40 mb-3 group-hover:text-[var(--brand)] group-hover:bg-[var(--brand-a)] group-hover:border-[var(--brand)]/30 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                  </div>
                  <p class="font-bold text-[13px] text-white/90 mb-3 flex-1 leading-tight group-hover:text-white" x-text="p.nombre"></p>
                  <div class="flex items-end justify-between mt-auto pt-3 border-t border-[var(--b0)]">
                    <p class="text-[9px] font-mono tracking-widest text-white/40" x-text="p.codigo"></p>
                    <p class="font-mono font-bold text-[var(--brand)] text-[15px]" x-text="'S/ '+parseFloat(p.precio1).toFixed(2)"></p>
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
        <div class="w-[380px] flex flex-col bg-[var(--s1)] rounded-2xl border border-[var(--b0)] overflow-hidden flex-shrink-0 shadow-lg">
          <div class="p-5 border-b border-[var(--b0)] bg-[var(--s2)]/50">
            <label class="text-[9.5px] text-white/50 uppercase tracking-widest block mb-2 font-bold">Cliente Seleccionado</label>
            <select x-model="posClienteId" class="w-full text-sm bg-[var(--s2)] border border-[var(--b1)] rounded-xl text-white py-2 px-3 focus:outline-none focus:border-[var(--brand)] transition-colors">
              <option value="">Cliente Genérico (Venta Rápida)</option>
              <template x-for="c in clientes">
                <option :value="c.id" x-text="c.razon+' ('+c.nroDoc+')'"></option>
              </template>
            </select>
          </div>

          <div class="flex-1 overflow-y-auto">
            <div class="px-5 py-3 bg-[var(--s1)] border-b border-[var(--b0)] flex justify-between items-center sticky top-0 z-10 shadow-sm">
              <span class="text-[9px] font-bold text-white/40 uppercase tracking-widest">Resumen de Orden</span>
              <button @click="carrito=[]" x-show="carrito.length>0" class="text-[9px] font-bold uppercase tracking-wider text-[var(--red)] hover:text-white hover:bg-[var(--red-a)] px-2 py-1 rounded transition-colors">Vaciar Cart</button>
            </div>

            <div x-show="carrito.length===0" class="flex flex-col items-center justify-center p-8 h-48 text-white/30 text-center text-[13px]">
              <div class="w-16 h-16 bg-[var(--s2)] border border-[var(--b1)] rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
              </div>
              El carrito está vacío.<br>Selecciona un producto del catálogo.
            </div>

            <div class="divide-y divide-[var(--b0)]">
              <template x-for="(item, index) in carrito" :key="index">
                <div class="p-5 hover:bg-white/[0.02] transition-colors group cursor-default">
                  <div class="flex justify-between mb-3">
                    <p class="text-[13px] font-semibold text-white/90 flex-1 pr-3 leading-tight group-hover:text-white" x-text="item.nombre"></p>
                    <button @click="carrito.splice(index,1)" class="text-white/20 hover:text-[var(--red)] hover:bg-[var(--red-a)] p-1 rounded transition-colors h-fit"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                  </div>
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1 bg-[var(--s2)] rounded-lg border border-[var(--b1)] p-0.5 shadow-inner">
                      <button @click="if(item.cantidad>1) item.cantidad--" class="w-8 h-8 flex items-center justify-center text-white/70 hover:bg-white/10 hover:text-white rounded-md transition-colors font-bold">-</button>
                      <input type="number" x-model.number="item.cantidad" class="w-10 text-center bg-transparent border-none p-0 text-sm font-mono font-bold text-white focus:outline-none" min="1">
                      <button @click="item.cantidad++" class="w-8 h-8 flex items-center justify-center text-white/70 hover:bg-white/10 hover:text-white rounded-md transition-colors font-bold">+</button>
                    </div>
                    <p class="font-mono font-bold text-[15px] text-[var(--brand)]" x-text="'S/ '+(item.precio*item.cantidad).toFixed(2)"></p>
                  </div>
                </div>
              </template>
            </div>
          </div>

          <!-- Totals -->
          <div class="p-5 bg-[var(--s2)] border-t border-[var(--b0)] flex-shrink-0 shadow-[0_-10px_30px_rgba(0,0,0,0.5)] z-20">
            <div class="space-y-2.5 mb-5">
              <div class="flex justify-between text-[13px] text-white/60">
                <span>Subtotal</span>
                <span class="font-mono text-white/90" x-text="'S/ '+(totalCarrito()/1.18).toFixed(2)"></span>
              </div>
              <div class="flex justify-between text-[13px] text-white/60">
                <span>IGV (18%)</span>
                <span class="font-mono text-white/90" x-text="'S/ '+(totalCarrito()-totalCarrito()/1.18).toFixed(2)"></span>
              </div>
              <div class="flex justify-between items-end pt-3.5 border-t border-[var(--b0)]">
                <span class="text-[10px] font-bold uppercase text-white/50 tracking-widest">Total Pagar</span>
                <span class="text-2xl font-mono tracking-tight font-extrabold text-[var(--brand)]" x-text="'S/ '+totalCarrito().toFixed(2)"></span>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-3 mb-5">
              <div>
                <label class="text-[9px] text-white/50 uppercase tracking-widest block mb-1.5 font-bold">Tipo Doc.</label>
                <select x-model="posTipoComprobante" class="w-full text-sm bg-[var(--s1)] border border-[var(--b1)] rounded-xl text-white py-2 px-3 focus:outline-none focus:border-[var(--brand)]">
                  <option value="Boleta">Boleta</option>
                  <option value="Factura">Factura</option>
                  <option value="Ticket">Ticket Interno</option>
                </select>
              </div>
              <div>
                <label class="text-[9px] text-white/50 uppercase tracking-widest block mb-1.5 font-bold">Método Pago</label>
                <select x-model="posMedioPago" class="w-full text-sm bg-[var(--s1)] border border-[var(--b1)] rounded-xl text-white py-2 px-3 focus:outline-none focus:border-[var(--brand)]">
                  <option value="Efectivo">Efectivo</option>
                  <option value="Yape/Plin">Yape/Plin</option>
                  <option value="Tarjeta">Tarjeta</option>
                  <option value="Transferencia">Banco</option>
                </select>
              </div>
            </div>
            <button class="w-full py-3.5 rounded-xl text-sm font-extrabold uppercase tracking-widest transition-all flex items-center justify-center gap-2"
              :disabled="carrito.length===0"
              :class="carrito.length===0?'bg-[var(--s3)] border border-[var(--b1)] text-white/30 cursor-not-allowed':'bg-[var(--brand)] text-[#0a0a0a] hover:brightness-125 shadow-[0_4_20px_var(--brand-a)]'"
              @click="abrirCobro()">
              <svg class="w-4 h-4" :class="carrito.length===0?'opacity-50':''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
              INICIAR COBRO
            </button>
          </div>
        </div>
      </div>

      


    </div><!-- /content -->
</div><!-- /main -->
</div><!-- /app -->

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

<!-- Modal: Cobro POS -->
<div x-show="modalCobro" class="fixed inset-0 z-[60] flex items-center justify-center bg-black/80 backdrop-blur-md overflow-y-auto py-10" style="display:none;" @keydown.escape.window="modalCobro=false">
  <div class="bg-[var(--s1)] border border-[var(--b1)] rounded-3xl w-full max-w-sm p-8 shadow-2xl relative text-center mx-4 my-auto">
    <h3 class="font-extrabold tracking-tight text-white/80 uppercase text-xs tracking-widest mb-1">Total a Cobrar</h3>
    <div class="text-5xl font-mono font-black text-[var(--brand)] mb-6" x-text="'S/ '+totalCarrito().toFixed(2)"></div>
    
    <div class="mb-4 text-left p-4 bg-[var(--s2)] rounded-xl border border-[var(--b0)]" x-show="!posClienteId">
      <p class="text-[9px] text-white/40 uppercase tracking-widest block font-bold mb-3">Datos del cliente (Opcional)</p>
      <input type="text" x-model="cobroNombre" placeholder="Nombre completo" class="w-full text-sm bg-transparent border-b border-[var(--b1)] text-white py-1 outline-none mb-3 focus:border-[var(--brand)] transition-colors">
      <div class="flex gap-3">
        <input type="text" x-model="cobroDoc" placeholder="RUC / DNI" class="w-1/2 text-sm bg-transparent border-b border-[var(--b1)] text-white py-1 outline-none focus:border-[var(--brand)] transition-colors">
        <input type="text" x-model="cobroDireccion" placeholder="Dirección" class="w-1/2 text-sm bg-transparent border-b border-[var(--b1)] text-white py-1 outline-none focus:border-[var(--brand)] transition-colors">
      </div>
    </div>

    <div class="mb-6 text-left">
      <label class="text-[10px] text-white/40 uppercase tracking-widest block mb-2 font-bold">Monto Recibido</label>
      <input type="tel" inputmode="decimal" x-model="montoRecibido" class="w-full text-center bg-[var(--s2)] border-2 border-[var(--brand)]/30 focus:border-[var(--brand)] rounded-2xl py-4 text-3xl font-mono text-white font-bold transition-all focus:outline-none shadow-inner" placeholder="0.00" @keydown.enter="confirmarCobro()">
    </div>

    <div class="bg-[var(--s2)] rounded-xl p-4 mb-8 flex justify-between items-center border border-[var(--b0)] shadow-inner">
      <span class="text-xs font-bold uppercase tracking-widest text-white/60">Vuelto</span>
      <span class="text-2xl font-mono font-bold" :class="getVuelto() < 0 ? 'text-[var(--red)]' : 'text-white'" x-text="'S/ '+Math.max(0, getVuelto()).toFixed(2)"></span>
    </div>

    <div class="flex gap-3">
      <button class="flex-1 py-3.5 rounded-xl border border-[var(--b1)] text-white/60 hover:text-white hover:bg-[var(--s2)] transition-colors font-bold text-sm tracking-wide" @click="modalCobro=false">CANCELAR</button>
      <button class="flex-1 py-3.5 rounded-xl bg-[var(--brand)] text-[#0a0a0a] hover:brightness-125 transition-all font-extrabold text-sm tracking-wide shadow-[0_4_20px_var(--brand-a)]" :disabled="getVuelto() < 0 && posMedioPago === 'Efectivo'" :class="getVuelto() < 0 && posMedioPago === 'Efectivo'?'opacity-50 cursor-not-allowed':''" @click="confirmarCobro()">EMITIR TICKET</button>
    </div>
  </div>
</div>

<!-- TICKET PRINT AREA -->
<div class="fixed inset-0 z-[100] bg-black/60 flex items-center justify-center p-4" x-show="ticketVenta" style="display:none;">
    <template x-if="ticketVenta">
        <div class="print-area font-mono bg-white text-black p-6 shadow-2xl relative w-full max-w-sm mx-auto my-auto max-h-[90vh] overflow-y-auto">
            <div style="font-family: 'JetBrains Mono', monospace; font-size: 12px; width: 100%; max-width: 320px; margin: 0 auto;" id="ticket-content">
                <div style="text-align: center; margin-bottom: 10px;">
                    <h2 style="margin: 0; font-size: 18px; font-weight: 800;">AUTOCARS CABRERA</h2>
                    <p style="margin: 2px 0;">RUC: 20123456789</p>
                    <p style="margin: 2px 0;">Av. Industrial 451, Taller Central</p>
                    <p style="margin: 2px 0;">Telf: 01-555-1234</p>
                    <p style="margin: 10px 0; font-weight: bold; font-size: 14px;" x-text="ticketVenta.tipoDoc.toUpperCase() + ' ELECTRÓNICA'"></p>
                    <p style="margin: 2px 0; font-weight: bold;" x-text="ticketVenta.ref"></p>
                    <hr style="border-top: 1px dashed #000; margin: 10px 0;">
                </div>
                
                <div style="margin-bottom: 10px;">
                    <p style="margin: 2px 0;"><strong>FECHA:</strong> <span x-text="ticketVenta.fecha"></span></p>
                    <p style="margin: 2px 0;"><strong>CLIENTE:</strong> <span x-text="ticketVenta.nombre"></span></p>
                    <p style="margin: 2px 0;"><strong>RUC/DNI:</strong> <span x-text="ticketVenta.ruc"></span></p>
                    <p style="margin: 2px 0;" x-show="ticketVenta.direccion"><strong>DIR:</strong> <span x-text="ticketVenta.direccion"></span></p>
                    <p style="margin: 2px 0;"><strong>CAJERO:</strong> ADMIN</p>
                </div>
                
                <hr style="border-top: 1px dashed #000; margin: 10px 0;">
                
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
                    <thead>
                        <tr style="border-bottom: 1px dashed #000;">
                            <th style="padding: 2px 0; text-align: left;">CANT</th>
                            <th style="padding: 2px 0; text-align: left;">DESCRIPCIÓN</th>
                            <th style="padding: 2px 0; text-align: right;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="item in ticketVenta.carrito">
                            <tr>
                                <td style="padding: 4px 0; vertical-align: top;" x-text="item.cantidad"></td>
                                <td style="padding: 4px 0; padding-right: 5px;">
                                    <div x-text="item.nombre"></div>
                                    <div style="font-size: 10px; color: #555;" x-text="item.codigo + ' (S/ ' + parseFloat(item.precio).toFixed(2) + ')'"></div>
                                </td>
                                <td style="padding: 4px 0; text-align: right; vertical-align: top;" x-text="(item.precio * item.cantidad).toFixed(2)"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                
                <hr style="border-top: 1px dashed #000; margin: 10px 0;">
                
                <table style="width: 100%; margin-bottom: 15px;">
                    <tr>
                        <td style="text-align: right; width: 70%;">Subtotal:</td>
                        <td style="text-align: right;">S/ <span x-text="ticketVenta.subtotal"></span></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">IGV (18%):</td>
                        <td style="text-align: right;">S/ <span x-text="ticketVenta.igv"></span></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: bold; font-size: 14px; padding-top: 5px;">TOTAL:</td>
                        <td style="text-align: right; font-weight: bold; font-size: 14px; padding-top: 5px;">S/ <span x-text="ticketVenta.total"></span></td>
                    </tr>
                </table>

                <hr style="border-top: 1px dashed #000; margin: 10px 0;">

                <div style="margin-bottom: 15px;">
                    <p style="margin: 2px 0;"><strong>MÉTODO DE PAGO:</strong> <span x-text="ticketVenta.metodo.toUpperCase()"></span></p>
                    <div x-show="ticketVenta.metodo === 'Efectivo'">
                        <p style="margin: 2px 0;"><strong>RECIBIDO:</strong> S/ <span x-text="ticketVenta.recibido"></span></p>
                        <p style="margin: 2px 0;"><strong>VUELTO:</strong> S/ <span x-text="ticketVenta.vuelto"></span></p>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 20px;">
                    <p style="margin: 2px 0; font-size: 10px;">Representación impresa de la <span x-text="ticketVenta.tipoDoc"></span> Electrónica.</p>
                    <p style="margin: 2px 0; font-weight: bold; font-size: 13px;">¡Gracias por su preferencia!</p>
                    
                    <!-- SVG BARCODE SIMULATION -->
                    <div style="margin-top: 15px; display: flex; justify-content: center;">
                        <svg width="200" height="40" viewBox="0 0 200 40" preserveAspectRatio="none">
                            <rect x="10" y="0" width="3" height="40" fill="black" />
                            <rect x="15" y="0" width="1" height="40" fill="black" />
                            <rect x="18" y="0" width="5" height="40" fill="black" />
                            <rect x="25" y="0" width="2" height="40" fill="black" />
                            <rect x="30" y="0" width="4" height="40" fill="black" />
                            <rect x="36" y="0" width="1" height="40" fill="black" />
                            <rect x="40" y="0" width="6" height="40" fill="black" />
                            <rect x="48" y="0" width="2" height="40" fill="black" />
                            <rect x="53" y="0" width="5" height="40" fill="black" />
                            <rect x="60" y="0" width="1" height="40" fill="black" />
                            <rect x="64" y="0" width="4" height="40" fill="black" />
                            <rect x="70" y="0" width="2" height="40" fill="black" />
                            <rect x="75" y="0" width="5" height="40" fill="black" />
                            <rect x="83" y="0" width="1" height="40" fill="black" />
                            <rect x="86" y="0" width="3" height="40" fill="black" />
                            <rect x="91" y="0" width="6" height="40" fill="black" />
                            <rect x="100" y="0" width="2" height="40" fill="black" />
                            <rect x="105" y="0" width="5" height="40" fill="black" />
                            <rect x="113" y="0" width="1" height="40" fill="black" />
                            <rect x="116" y="0" width="4" height="40" fill="black" />
                            <rect x="123" y="0" width="2" height="40" fill="black" />
                            <rect x="128" y="0" width="7" height="40" fill="black" />
                            <rect x="138" y="0" width="1" height="40" fill="black" />
                            <rect x="141" y="0" width="4" height="40" fill="black" />
                            <rect x="147" y="0" width="2" height="40" fill="black" />
                            <rect x="151" y="0" width="5" height="40" fill="black" />
                            <rect x="158" y="0" width="1" height="40" fill="black" />
                            <rect x="162" y="0" width="4" height="40" fill="black" />
                            <rect x="168" y="0" width="3" height="40" fill="black" />
                            <rect x="174" y="0" width="2" height="40" fill="black" />
                            <rect x="178" y="0" width="5" height="40" fill="black" />
                            <rect x="186" y="0" width="1" height="40" fill="black" />
                            <rect x="190" y="0" width="7" height="40" fill="black" />
                        </svg>
                    </div>
                    <p style="font-size: 10px; margin-top: 5px; letter-spacing: 2px;" x-text="ticketVenta.ref.replace('-', '') + '045920'"></p>
                </div>
            </div>
            
            <div class="no-print mt-6 flex justify-center gap-4 border-t border-gray-200 pt-4">
                <button class="px-6 py-2 bg-gray-200 rounded text-black font-bold uppercase hover:bg-gray-300" @click="ticketVenta=null">Cerrar</button>
                <button class="px-6 py-2 bg-blue-600 rounded text-white font-bold uppercase hover:bg-blue-700" onclick="window.print()">🖨️ IMPRIMIR</button>
            </div>
        </div>
    </template>
</div>

<!-- Toast -->
<div x-show="showToast" x-transition class="fixed bottom-6 right-6 z-[1000] py-3 px-5 rounded-xl bg-surface/90 backdrop-blur-xl border border-border-light flex items-center gap-3 shadow-2xl" style="display:none;">
  <div class="w-2.5 h-2.5 rounded-full" :class="toastTipo==='error'?'bg-primary':'bg-success'"></div>
  <span class="font-bold text-white text-sm" x-text="toastMsg"></span>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
/* ── CHART ── */
const ctx = document.getElementById('mainChart').getContext('2d');
const datasets = {
    hoy: {labels:['8h','9h','10h','11h','12h','13h','14h','15h','16h','17h','18h'],data:[0,0,0,0,0,0,0,0,0,0,0]},
    sem: {labels:['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'],data:[320,480,290,510,720,410,0]},
    mes: {labels:Array.from({length:19},(_,i)=>i+1+''),data:[800,1200,950,1400,600,1100,1350,900,1600,1200,800,1450,1100,950,1300,1600,1200,1050,0]},
};
const grad = ctx.createLinearGradient(0,0,0,80);
grad.addColorStop(0,'rgba(240,52,26,0.18)');
grad.addColorStop(1,'rgba(240,52,26,0)');

let chart = new Chart(ctx,{
    type:'line',
    data:{
        labels:datasets.hoy.labels,
        datasets:[{
            data:datasets.hoy.data,
            borderColor:'var(--red)',
            borderWidth:1.5,
            backgroundColor:grad,
            fill:true,
            tension:0.4,
            pointRadius:0,
            pointHoverRadius:4,
            pointHoverBackgroundColor:'var(--red)',
        }]
    },
    options:{
        responsive:true,maintainAspectRatio:false,
        plugins:{legend:{display:false},tooltip:{
            backgroundColor:'#1e1e24',
            borderColor:'rgba(255,255,255,0.08)',borderWidth:1,
            titleColor:'#9898a6',bodyColor:'#f5f5f6',
            titleFont:{size:11,family:"'Cabinet Grotesk',sans-serif"},
            bodyFont:{size:13,weight:'700',family:"'Geist Mono',monospace"},
            padding:10,callbacks:{label:c=>'S/ '+c.parsed.y.toFixed(2)},
        }},
        scales:{
            x:{grid:{display:false},ticks:{color:'#52525f',font:{size:10,family:"'Cabinet Grotesk',sans-serif"},maxRotation:0}},
            y:{display:false,grid:{display:false}},
        },
    }
});

function setChartTab(el,t){
    document.querySelectorAll('.chart-tab').forEach(b=>b.classList.remove('active'));
    el.classList.add('active');
    chart.data.labels = datasets[t].labels;
    chart.data.datasets[0].data = datasets[t].data;
    chart.update('active');
}

/* ── MODALS ── */
function openModal(id){
    document.getElementById(id).classList.add('show');
    if(id==='modalStock') loadProductosSelect();
}
function closeModal(id){
    document.getElementById(id).classList.remove('show');
    const msg = document.querySelector('#'+id+' .sb-modal-msg');
    if(msg){msg.className='sb-modal-msg';msg.textContent='';}
}
document.querySelectorAll('.sb-modal-overlay').forEach(o=>{
    o.addEventListener('click',e=>{if(e.target===o) closeModal(o.id);});
});

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

async function saveProducto(e){
    e.preventDefault();
    const form = e.target;
    const data = Object.fromEntries(new FormData(form));
    const msg = document.getElementById('msgProducto');
    try{
        const r = await fetch('/api/inventario',{
            method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},
            body:JSON.stringify(data)
        });
        if(!r.ok) throw new Error('Error');
        msg.className='sb-modal-msg success';
        msg.textContent='Producto guardado correctamente';
        form.reset();
        setTimeout(()=>location.reload(),1200);
    }catch(err){
        msg.className='sb-modal-msg error';
        msg.textContent='Error al guardar producto';
    }
    return false;
}

async function loadProductosSelect(){
    const sel = document.getElementById('stockProductoSelect');
    if(sel.options.length>1) return;
    try{
        const r = await fetch('/api/inventario');
        const items = await r.json();
        items.forEach(p=>{
            const opt = document.createElement('option');
            opt.value = p.id;
            opt.textContent = p.nombre + ' (Stock: '+p.stock+')';
            sel.appendChild(opt);
        });
    }catch(err){}
}

async function addStock(e){
    e.preventDefault();
    const form = e.target;
    const fd = new FormData(form);
    const prodId = fd.get('producto_id');
    const cant = parseInt(fd.get('cantidad'));
    const msg = document.getElementById('msgStock');
    try{
        const r1 = await fetch('/api/inventario');
        const items = await r1.json();
        const prod = items.find(p=>p.id==prodId);
        if(!prod) throw new Error('No encontrado');
        prod.stock = (prod.stock||0) + cant;
        const r2 = await fetch('/api/inventario',{
            method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},
            body:JSON.stringify(prod)
        });
        if(!r2.ok) throw new Error('Error');
        msg.className='sb-modal-msg success';
        msg.textContent='Stock actualizado: +'+cant+' unidades';
        form.reset();
        setTimeout(()=>location.reload(),1200);
    }catch(err){
        msg.className='sb-modal-msg error';
        msg.textContent='Error al actualizar stock';
    }
    return false;
}
</script>
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
    modalCobro: false,
    montoRecibido: 0,
    ticketVenta: null,
    modalCliente: false,
    modalInv: false,
    toastMsg: '',
    toastTipo: 'info',
    showToast: false,
    editCliente: null,
    editInv: null,
    cobroNombre: '',
    cobroDoc: '',
    cobroDireccion: '',
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

    getVuelto() {
      const total = this.totalCarrito();
      let recibidoNum = 0;
      if (typeof this.montoRecibido === 'string') {
        recibidoNum = parseFloat(this.montoRecibido.replace(',', '.'));
      } else {
        recibidoNum = parseFloat(this.montoRecibido);
      }
      if (isNaN(recibidoNum)) recibidoNum = 0;
      return recibidoNum - total;
    },

    abrirCobro() {
      if(this.carrito.length===0) return;
      this.montoRecibido = this.totalCarrito().toFixed(2);
      this.cobroNombre = '';
      this.cobroDoc = '';
      this.cobroDireccion = '';
      this.ticketVenta = null; // Clear old ticket
      this.modalCobro = true;
    },

    async confirmarCobro() {
      const total = this.totalCarrito();
      
      // Sanitizar el montoRecibido por si tiene comas
      let recibidoNum = 0;
      if (typeof this.montoRecibido === 'string') {
        recibidoNum = parseFloat(this.montoRecibido.replace(',', '.'));
      } else {
        recibidoNum = parseFloat(this.montoRecibido);
      }
      if (isNaN(recibidoNum)) recibidoNum = total;

      if(recibidoNum < total && this.posMedioPago === 'Efectivo') {
        alert('El monto recibido no puede ser menor al total.');
        return;
      }
      
      const rdm = Math.floor(Math.random()*9000)+1000;
      const ref = (this.posTipoComprobante==='Factura'?'F':(this.posTipoComprobante==='Boleta'?'B':'T'))+'001-'+rdm;
      let nombre = this.cobroNombre || 'Cliente Genérico';
      let ruc = this.cobroDoc || '00000000';
      if(this.posClienteId) { const c=this.clientes.find(x=>x.id==this.posClienteId); if(c) { nombre=c.razon; ruc=c.nroDoc; } }
      const d = new Date();
      const hm = d.getHours().toString().padStart(2,'0')+':'+d.getMinutes().toString().padStart(2,'0');
      const payload = { metodo:this.posMedioPago, concepto:`Venta (${this.posTipoComprobante}) - ${nombre}`, monto:total.toFixed(2), referencia:ref, fecha:d.toLocaleDateString()+' '+hm, carrito:this.carrito };
      
      try {
        await this.apiFetch('/api/venta','POST',payload);
        await this.refreshAll();
        
        // Armar datos del ticket
        this.ticketVenta = {
            ref: ref,
            tipoDoc: this.posTipoComprobante,
            fecha: d.toLocaleDateString()+' '+hm,
            nombre: nombre,
            ruc: ruc,
            direccion: this.cobroDireccion || '',
            carrito: [...this.carrito],
            subtotal: (total/1.18).toFixed(2),
            igv: (total - total/1.18).toFixed(2),
            total: total.toFixed(2),
            metodo: this.posMedioPago,
            recibido: recibidoNum.toFixed(2),
            vuelto: Math.max(0, recibidoNum - total).toFixed(2)
        };
        
        this.triggerToast('Venta procesada: '+ref);
        this.carrito=[];
        this.posClienteId='';
        this.modalCobro=false;

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
